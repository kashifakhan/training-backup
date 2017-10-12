<?php

/*
 * This file is part of the puli/repository package.
 *
 * (c) Bernhard Schussek <bschussek@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Puli\Repository;

use InvalidArgumentException;
use Puli\Repository\Api\ChangeStream\VersionList;
use Puli\Repository\Api\EditableRepository;
use Puli\Repository\Api\NoVersionFoundException;
use Puli\Repository\Api\Resource\PuliResource;
use RecursiveIteratorIterator;
use Webmozart\Glob\Glob;
use Webmozart\Glob\Iterator\RecursiveDirectoryIterator;
use Webmozart\PathUtil\Path;

/**
 * A repository backed by a JSON file optimized for development.
 *
 * The generated JSON file is described by res/schema/repository-schema-1.0.json.
 *
 * Resources can be added with the method {@link add()}:
 *
 * ```php
 * use Puli\Repository\JsonRepository;
 *
 * $repo = new JsonRepository('/path/to/repository.json', '/path/to/project');
 * $repo->add('/css', new DirectoryResource('/path/to/project/res/css'));
 * ```
 *
 * When adding a resource, the added filesystem path is stored in the JSON file
 * under the key of the Puli path. The path is stored relatively to the base
 * directory passed to the constructor:
 *
 * ```json
 * {
 *     "/css": "res/css"
 * }
 * ```
 *
 * Mapped resources can be read with the method {@link get()}:
 *
 * ```php
 * $cssPath = $repo->get('/css')->getFilesystemPath();
 * ```
 *
 * You can also access nested files:
 *
 * ```php
 * echo $repo->get('/css/style.css')->getBody();
 * ```
 *
 * Nested files are searched during {@link get()}. As a consequence, this
 * implementation should not be used in production environments. Use
 * {@link OptimizedJsonRepository} instead which searches nested files during
 * {@link add()} and has much faster read performance.
 *
 * @since  1.0
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 * @author Titouan Galopin <galopintitouan@gmail.com>
 */
class JsonRepository extends AbstractJsonRepository implements EditableRepository
{
    /**
     * Flag: Don't search the contents of mapped directories for matching paths.
     *
     * @internal
     */
    const NO_SEARCH_FILESYSTEM = 2;

    /**
     * Flag: Don't filter out references that don't exist on the filesystem.
     *
     * @internal
     */
    const NO_CHECK_FILE_EXISTS = 4;

    /**
     * Flag: Include the references for mapped ancestor paths /a of a path /a/b.
     *
     * @internal
     */
    const INCLUDE_ANCESTORS = 8;

    /**
     * Flag: Include the references for mapped nested paths /a/b of a path /a.
     *
     * @internal
     */
    const INCLUDE_NESTED = 16;

    /**
     * Creates a new repository.
     *
     * @param string $path          The path to the JSON file. If relative, it
     *                              must be relative to the base directory.
     * @param string $baseDirectory The base directory of the store. Paths
     *                              inside that directory are stored as relative
     *                              paths. Paths outside that directory are
     *                              stored as absolute paths.
     * @param bool   $validateJson  Whether to validate the JSON file against
     *                              the schema. Slow but spots problems.
     */
    public function __construct($path, $baseDirectory, $validateJson = false)
    {
        // Does not accept ChangeStream objects
        // The ChangeStream functionality is implemented by the repository itself
        parent::__construct($path, $baseDirectory, $validateJson);
    }

    /**
     * {@inheritdoc}
     */
    public function getVersions($path)
    {
        if (!$this->json) {
            $this->load();
        }

        $references = $this->searchReferences($path);

        if (!isset($references[$path])) {
            throw NoVersionFoundException::forPath($path);
        }

        $resources = array();
        $pathReferences = $references[$path];

        // The first reference is the last (current) version
        // Hence traverse in reverse order
        for ($ref = end($pathReferences); null !== key($pathReferences); $ref = prev($pathReferences)) {
            $resources[] = $this->createResource($path, $ref);
        }

        return new VersionList($path, $resources);
    }

    /**
     * {@inheritdoc}
     */
    protected function storeVersion(PuliResource $resource)
    {
        $path = $resource->getPath();

        // Newly inserted parent directories and the resource need to be
        // sorted before we can correctly search references below
        krsort($this->json);

        // If a mapping exists for a sub-path of this resource
        // (e.g. $path = /a, mapped sub-path = /a/b)
        // we need to record the order, since by default sub-paths are
        // preferred over super paths

        $references = $this->searchReferences(
            $path,
            // Don't do filesystem checks here. We only check the filesystem
            // when reading, not when adding.
            self::NO_SEARCH_FILESYSTEM | self::NO_CHECK_FILE_EXISTS
                // Include references for mapped ancestor and nested paths
                | self::INCLUDE_ANCESTORS | self::INCLUDE_NESTED
        );

        // Filter virtual resources
        $references = array_filter($references, function ($currentReferences) {
            return array(null) !== $currentReferences;
        });

        // The $references contain:
        // - any sub references (e.g. /a/b/c, /a/b/d)
        // - the reference itself at $pos (e.g. /a/b)
        // - non-null parent references (e.g. /a)
        // (in that order, since long paths are sorted before short paths)
        $pos = array_search($path, array_keys($references), true);

        // We need to do three things:

        // 1. If any parent mapping has an order defined, inherit that order

        if ($pos + 1 < count($references)) {
            // Inherit the parent order if necessary
            if (!isset($this->json['_order'][$path])) {
                $parentReferences = array_slice($references, $pos + 1);

                $this->initWithParentOrder($path, $parentReferences);
            }

            // A parent order was inherited. Insert the path itself.
            if (isset($this->json['_order'][$path])) {
                $this->prependOrderEntry($path, $path);
            }
        }

        // 2. If there are child mappings, insert the current path into their order

        if ($pos > 0) {
            $subReferences = array_slice($references, 0, $pos);

            foreach ($subReferences as $subPath => $_) {
                if (isset($this->json['_order'][$subPath])) {
                    continue;
                }

                if (isset($this->json['_order'][$path])) {
                    $this->json['_order'][$subPath] = $this->json['_order'][$path];
                } else {
                    $this->initWithDefaultOrder($subPath, $path, $references);
                }
            }

            // After initializing all order entries, insert the new one
            foreach ($subReferences as $subPath => $_) {
                $this->prependOrderEntry($subPath, $path);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function insertReference($path, $reference)
    {
        if (!isset($this->json[$path])) {
            // Store first entries as simple reference
            $this->json[$path] = $reference;

            return;
        }

        if ($reference === $this->json[$path]) {
            // Reference is already set
            return;
        }

        if (!is_array($this->json[$path])) {
            // Convert existing entries to arrays for follow ups
            $this->json[$path] = array($this->json[$path]);
        }

        if (!in_array($reference, $this->json[$path], true)) {
            // Insert at the beginning of the array
            array_unshift($this->json[$path], $reference);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function removeReferences($glob)
    {
        $checkResults = $this->getReferencesForGlob($glob);
        $nonDeletablePaths = array();

        foreach ($checkResults as $path => $filesystemPath) {
            if (!array_key_exists($path, $this->json)) {
                $nonDeletablePaths[] = $filesystemPath;
            }
        }

        if (count($nonDeletablePaths) > 0) {
            throw new InvalidArgumentException(sprintf(
                'You cannot remove resources that are not mapped in the JSON '.
                'file. Tried to remove %s%s.',
                reset($nonDeletablePaths),
                count($nonDeletablePaths) > 1
                    ? ' and '.(count($nonDeletablePaths) - 1).' more'
                    : ''
            ));
        }

        $deletedPaths = $this->getReferencesForGlob($glob.'{,/**/*}', self::NO_SEARCH_FILESYSTEM);
        $removed = 0;

        foreach ($deletedPaths as $path => $filesystemPath) {
            $removed += 1 + count($this->getReferencesForGlob($path.'/**/*'));

            unset($this->json[$path]);
        }

        return $removed;
    }

    /**
     * {@inheritdoc}
     */
    protected function getReferencesForPath($path)
    {
        // Stop on first result and flatten
        return $this->flatten($this->searchReferences($path, self::STOP_ON_FIRST));
    }

    /**
     * {@inheritdoc}
     */
    protected function getReferencesForGlob($glob, $flags = 0)
    {
        if (!Glob::isDynamic($glob)) {
            return $this->getReferencesForPath($glob);
        }

        return $this->getReferencesForRegex(
            Glob::getBasePath($glob),
            Glob::toRegEx($glob),
            $flags
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getReferencesForRegex($staticPrefix, $regex, $flags = 0, $maxDepth = 0)
    {
        return $this->flattenWithFilter(
            // Never stop on the first result before applying the filter since
            // the filter may reject the only returned path
            $this->searchReferences($staticPrefix, self::INCLUDE_NESTED),
            $regex,
            $flags,
            $maxDepth
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getReferencesInDirectory($path, $flags = 0)
    {
        $basePath = rtrim($path, '/');

        return $this->getReferencesForRegex(
            $basePath.'/',
            '~^'.preg_quote($basePath, '~').'/[^/]+$~',
            $flags,
            // Limit the directory exploration to the depth of the path + 1
            $this->getPathDepth($path) + 1
        );
    }

    /**
     * Flattens a two-level reference array into a one-level array.
     *
     * For each entry on the first level, only the first entry of the second
     * level is included in the result.
     *
     * Each reference returned by this method can be:
     *
     *  * `null`
     *  * a link starting with `@`
     *  * an absolute filesystem path
     *
     * The keys of the returned array are Puli paths. Their order is undefined.
     *
     * @param array $references A two-level reference array as returned by
     *                          {@link searchReferences()}.
     *
     * @return string[]|null[] A one-level array of references with Puli paths
     *                         as keys.
     */
    private function flatten(array $references)
    {
        $result = array();

        foreach ($references as $currentPath => $currentReferences) {
            if (!isset($result[$currentPath])) {
                $result[$currentPath] = reset($currentReferences);
            }
        }

        return $result;
    }

    /**
     * Flattens a two-level reference array into a one-level array and filters
     * out any references that don't match the given regular expression.
     *
     * This method takes a two-level reference array as returned by
     * {@link searchReferences()}. The references are scanned for Puli paths
     * matching the given regular expression. Those matches are returned.
     *
     * If a matching path refers to more than one reference, the first reference
     * is returned in the resulting array.
     *
     * If `$listDirectories` is set to `true`, all references that contain
     * directory paths are traversed recursively and scanned for more paths
     * matching the regular expression. This recursive traversal can be limited
     * by passing a `$maxDepth` (see {@link getPathDepth()}).
     *
     * Each reference returned by this method can be:
     *
     *  * `null`
     *  * a link starting with `@`
     *  * an absolute filesystem path
     *
     * The keys of the returned array are Puli paths. Their order is undefined.
     *
     * @param array  $references A two-level reference array as returned by
     *                           {@link searchReferences()}.
     * @param string $regex      A regular expression used to filter Puli paths.
     * @param int    $flags      A bitwise combination of the flag constants in
     *                           this class.
     * @param int    $maxDepth   The maximum path depth when searching the
     *                           contents of directory references. If 0, the
     *                           depth is unlimited.
     *
     * @return string[]|null[] A one-level array of references with Puli paths
     *                         as keys.
     */
    private function flattenWithFilter(array $references, $regex, $flags = 0, $maxDepth = 0)
    {
        $result = array();

        foreach ($references as $currentPath => $currentReferences) {
            // Check whether the current entry matches the pattern
            if (!isset($result[$currentPath]) && preg_match($regex, $currentPath)) {
                // If yes, the first stored reference is returned
                $result[$currentPath] = reset($currentReferences);

                if ($flags & self::STOP_ON_FIRST) {
                    return $result;
                }
            }

            if ($flags & self::NO_SEARCH_FILESYSTEM) {
                continue;
            }

            // First follow any links before we check which of them is a directory
            $currentReferences = $this->followLinks($currentReferences);
            $currentPath = rtrim($currentPath, '/');

            // Search the nested entries if desired
            foreach ($currentReferences as $baseFilesystemPath) {
                // Ignore null values and file paths
                if (!is_dir($baseFilesystemPath)) {
                    continue;
                }

                $iterator = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator(
                        $baseFilesystemPath,
                        RecursiveDirectoryIterator::CURRENT_AS_PATHNAME
                            | RecursiveDirectoryIterator::SKIP_DOTS
                    ),
                    RecursiveIteratorIterator::SELF_FIRST
                );

                if (0 !== $maxDepth) {
                    $currentDepth = $this->getPathDepth($currentPath);
                    $maxIteratorDepth = $maxDepth - $currentDepth;

                    if ($maxIteratorDepth < 1) {
                        continue;
                    }

                    $iterator->setMaxDepth($maxIteratorDepth);
                }

                $basePathLength = strlen($baseFilesystemPath);

                foreach ($iterator as $nestedFilesystemPath) {
                    $nestedPath = substr_replace($nestedFilesystemPath, $currentPath, 0, $basePathLength);

                    if (!isset($result[$nestedPath]) && preg_match($regex, $nestedPath)) {
                        $result[$nestedPath] = $nestedFilesystemPath;

                        if ($flags & self::STOP_ON_FIRST) {
                            return $result;
                        }
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Filters the JSON file for all references relevant to a given search path.
     *
     * The JSON is scanned starting with the longest mapped Puli path.
     *
     * If the search path is "/a/b", the result includes:
     *
     *  * The references of the mapped path "/a/b".
     *  * The references of any mapped super path "/a" with the sub-path "/b"
     *    appended.
     *
     * If the argument `$includeNested` is set to `true`, the result
     * additionally includes:
     *
     *  * The references of any mapped sub path "/a/b/c".
     *
     * This is useful if you want to look for the children of "/a/b" or scan
     * all descendants for paths matching a given pattern.
     *
     * The result of this method is an array with two levels:
     *
     *  * The first level has Puli paths as keys.
     *  * The second level contains all references for that path, where the
     *    first reference has the highest, the last reference the lowest
     *    priority. The keys of the second level are integers. There may be
     *    holes between any two keys.
     *
     * The references of the second level contain:
     *
     *  * `null` values for virtual resources
     *  * strings starting with "@" for links
     *  * absolute filesystem paths for filesystem resources
     *
     * @param string $searchPath The path to search.
     * @param int    $flags      A bitwise combination of the flag constants in
     *                           this class.
     *
     * @return array An array with two levels.
     */
    private function searchReferences($searchPath, $flags = 0)
    {
        $result = array();
        $foundMatchingMappings = false;
        $searchPath = rtrim($searchPath, '/');
        $searchPathForTest = $searchPath.'/';

        foreach ($this->json as $currentPath => $currentReferences) {
            $currentPathForTest = rtrim($currentPath, '/').'/';

            // We found a mapping that matches the search path
            // e.g. mapping /a/b for path /a/b
            if ($searchPathForTest === $currentPathForTest) {
                $foundMatchingMappings = true;
                $currentReferences = $this->resolveReferences($currentPath, $currentReferences, $flags);

                if (empty($currentReferences)) {
                    continue;
                }

                $result[$currentPath] = $currentReferences;

                // Return unless an explicit mapping order is defined
                // In that case, the ancestors need to be searched as well
                if (($flags & self::STOP_ON_FIRST) && !isset($this->json['_order'][$currentPath])) {
                    return $result;
                }

                continue;
            }

            // We found a mapping that lies within the search path
            // e.g. mapping /a/b/c for path /a/b
            if (($flags & self::INCLUDE_NESTED) && 0 === strpos($currentPathForTest, $searchPathForTest)) {
                $foundMatchingMappings = true;
                $currentReferences = $this->resolveReferences($currentPath, $currentReferences, $flags);

                if (empty($currentReferences)) {
                    continue;
                }

                $result[$currentPath] = $currentReferences;

                // Return unless an explicit mapping order is defined
                // In that case, the ancestors need to be searched as well
                if (($flags & self::STOP_ON_FIRST) && !isset($this->json['_order'][$currentPath])) {
                    return $result;
                }

                continue;
            }

            // We found a mapping that is an ancestor of the search path
            // e.g. mapping /a for path /a/b
            if (0 === strpos($searchPathForTest, $currentPathForTest)) {
                $foundMatchingMappings = true;

                if ($flags & self::INCLUDE_ANCESTORS) {
                    // Include the references of the ancestor
                    $currentReferences = $this->resolveReferences($currentPath, $currentReferences, $flags);

                    if (empty($currentReferences)) {
                        continue;
                    }

                    $result[$currentPath] = $currentReferences;

                    // Return unless an explicit mapping order is defined
                    // In that case, the ancestors need to be searched as well
                    if (($flags & self::STOP_ON_FIRST) && !isset($this->json['_order'][$currentPath])) {
                        return $result;
                    }

                    continue;
                }

                if ($flags & self::NO_SEARCH_FILESYSTEM) {
                    continue;
                }

                // Check the filesystem directories pointed to by the ancestors
                // for the searched path
                $nestedPath = substr($searchPath, strlen($currentPathForTest));
                $currentPathWithNested = rtrim($currentPath, '/').'/'.$nestedPath;

                // Follow links so that we can check the nested directories in
                // the final transitive link targets
                $currentReferencesResolved = $this->followLinks(
                    // Never stop on first, since appendNestedPath() might
                    // discard the first but accept the second entry
                    $this->resolveReferences($currentPath, $currentReferences, $flags & (~self::STOP_ON_FIRST))
                );

                // Append the path and check which of the resulting paths exist
                $nestedReferences = $this->appendPathAndFilterExisting(
                    $currentReferencesResolved,
                    $nestedPath,
                    $flags
                );

                // None of the results exists
                if (empty($nestedReferences)) {
                    continue;
                }

                // Return unless an explicit mapping order is defined
                // In that case, the ancestors need to be searched as well
                if (($flags & self::STOP_ON_FIRST) && !isset($this->json['_order'][$currentPathWithNested])) {
                    // The nested references already have size 1
                    return array($currentPathWithNested => $nestedReferences);
                }

                // We are traversing long keys before short keys
                // It could be that this entry already exists.
                if (!isset($result[$currentPathWithNested])) {
                    $result[$currentPathWithNested] = $nestedReferences;

                    continue;
                }

                // If no explicit mapping order is defined, simply append the
                // new references to the existing ones
                if (!isset($this->json['_order'][$currentPathWithNested])) {
                    $result[$currentPathWithNested] = array_merge(
                        $result[$currentPathWithNested],
                        $nestedReferences
                    );

                    continue;
                }

                // If an explicit mapping order is defined, store the paths
                // of the mappings that generated each reference set and
                // resolve the order later on
                if (!isset($result[$currentPathWithNested][$currentPathWithNested])) {
                    $result[$currentPathWithNested] = array(
                        $currentPathWithNested => $result[$currentPathWithNested],
                    );
                }

                // Add the new references generated by the current mapping
                $result[$currentPathWithNested][$currentPath] = $nestedReferences;

                continue;
            }

            // We did not find anything but previously found mappings
            // The mappings are sorted alphabetically, so we can safely abort
            if ($foundMatchingMappings) {
                break;
            }
        }

        // Resolve the order where it is explicitly set
        if (!isset($this->json['_order'])) {
            return $result;
        }

        foreach ($result as $currentPath => $referencesByMappedPath) {
            // If no order is defined for the path or if only one mapped path
            // generated references, there's nothing to do
            if (!isset($this->json['_order'][$currentPath]) || !isset($referencesByMappedPath[$currentPath])) {
                continue;
            }

            $orderedReferences = array();

            foreach ($this->json['_order'][$currentPath] as $orderEntry) {
                if (!isset($referencesByMappedPath[$orderEntry['path']])) {
                    continue;
                }

                for ($i = 0; $i < $orderEntry['references'] && count($referencesByMappedPath[$orderEntry['path']]) > 0; ++$i) {
                    $orderedReferences[] = array_shift($referencesByMappedPath[$orderEntry['path']]);
                }

                // Only include references of the first mapped path
                // Since $stopOnFirst is set, those references have a
                // maximum size of 1
                if ($flags & self::STOP_ON_FIRST) {
                    break;
                }
            }

            $result[$currentPath] = $orderedReferences;
        }

        return $result;
    }

    /**
     * Follows any link in a list of references.
     *
     * This method takes all the given references, checks for links starting
     * with "@" and recursively expands those links to their target references.
     * The target references may be `null` or absolute filesystem paths.
     *
     * Null values are returned unchanged.
     *
     * Absolute filesystem paths are returned unchanged.
     *
     * @param string[]|null[] $references The references.
     * @param int             $flags      A bitwise combination of the flag
     *                                    constants in this class.
     *
     * @return string[]|null[] The references with all links replaced by their
     *                         target references. If any link pointed to more
     *                         than one target reference, the returned array
     *                         is larger than the passed array (unless the
     *                         argument `$stopOnFirst` was set to `true`).
     */
    private function followLinks(array $references, $flags = 0)
    {
        $result = array();

        foreach ($references as $key => $reference) {
            // Not a link
            if (!$this->isLinkReference($reference)) {
                $result[] = $reference;

                if ($flags & self::STOP_ON_FIRST) {
                    return $result;
                }

                continue;
            }

            $referencedPath = substr($reference, 1);

            // Get all the file system paths that this link points to
            // and append them to the result
            foreach ($this->searchReferences($referencedPath, $flags) as $referencedReferences) {
                // Follow links recursively
                $referencedReferences = $this->followLinks($referencedReferences);

                // Append all resulting target paths to the result
                foreach ($referencedReferences as $referencedReference) {
                    $result[] = $referencedReference;

                    if ($flags & self::STOP_ON_FIRST) {
                        return $result;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Appends nested paths to references and filters out the existing ones.
     *
     * This method takes all the given references, appends the nested path to
     * each of them and then filters out the results that actually exist on the
     * filesystem.
     *
     * Null references are filtered out.
     *
     * Link references should be followed with {@link followLinks()} before
     * calling this method.
     *
     * @param string[]|null[] $references The references.
     * @param string          $nestedPath The nested path to append without
     *                                    leading slash ("/").
     * @param int             $flags      A bitwise combination of the flag
     *                                    constants in this class.
     *
     * @return string[] The references with the nested path appended. Each
     *                  reference is guaranteed to exist on the filesystem.
     */
    private function appendPathAndFilterExisting(array $references, $nestedPath, $flags = 0)
    {
        $result = array();

        foreach ($references as $reference) {
            // Filter out null values
            // Links should be followed before calling this method
            if (null === $reference) {
                continue;
            }

            $nestedReference = rtrim($reference, '/').'/'.$nestedPath;

            if (file_exists($nestedReference)) {
                $result[] = $nestedReference;

                if ($flags & self::STOP_ON_FIRST) {
                    return $result;
                }
            }
        }

        return $result;
    }

    /**
     * Resolves a list of references stored in the JSON.
     *
     * Each reference passed in can be:
     *
     *  * `null`
     *  * a link starting with `@`
     *  * a filesystem path relative to the base directory
     *  * an absolute filesystem path
     *
     * Each reference returned by this method can be:
     *
     *  * `null`
     *  * a link starting with `@`
     *  * an absolute filesystem path
     *
     * Additionally, the results are guaranteed to be an array. If the
     * argument `$stopOnFirst` is set, that array has a maximum size of 1.
     *
     * @param string $path       The mapped Puli path.
     * @param mixed  $references The reference(s).
     * @param int    $flags      A bitwise combination of the flag constants in
     *                           this class.
     *
     * @return string[]|null[] The resolved references.
     */
    private function resolveReferences($path, $references, $flags = 0)
    {
        $result = array();

        if (!is_array($references)) {
            $references = array($references);
        }

        foreach ($references as $key => $reference) {
            // Keep non-filesystem references as they are
            if (!$this->isFilesystemReference($reference)) {
                $result[] = $reference;

                if ($flags & self::STOP_ON_FIRST) {
                    return $result;
                }

                continue;
            }

            $absoluteReference = Path::makeAbsolute($reference, $this->baseDirectory);
            $referenceExists = file_exists($absoluteReference);

            if (($flags & self::NO_CHECK_FILE_EXISTS) || $referenceExists) {
                $result[] = $absoluteReference;

                if ($flags & self::STOP_ON_FIRST) {
                    return $result;
                }
            }

            if (!$referenceExists) {
                $this->logReferenceNotFound($path, $reference, $absoluteReference);
            }
        }

        return $result;
    }

    /**
     * Returns the depth of a Puli path.
     *
     * The depth is used in order to limit the recursion when recursively
     * iterating directories.
     *
     * The depth starts at 0 for the root:
     *
     * /                0
     * /webmozart       1
     * /webmozart/puli  2
     * ...
     *
     * @param string $path A Puli path.
     *
     * @return int The depth starting with 0 for the root node.
     */
    private function getPathDepth($path)
    {
        // / has depth 0
        // /webmozart has depth 1
        // /webmozart/puli has depth 2
        // ...
        return substr_count(rtrim($path, '/'), '/');
    }

    /**
     * Inserts a path at the beginning of the order list of a mapped path.
     *
     * @param string $path          The path of the mapping where to prepend.
     * @param string $prependedPath The path of the mapping to prepend.
     */
    private function prependOrderEntry($path, $prependedPath)
    {
        $lastEntry = reset($this->json['_order'][$path]);

        if ($prependedPath === $lastEntry['path']) {
            // If the first entry matches the new one, add the reference
            // of the current resource to the limit
            ++$lastEntry['references'];
        } else {
            array_unshift($this->json['_order'][$path], array(
                'path' => $prependedPath,
                'references' => 1,
            ));
        }
    }

    /**
     * Initializes a path with the order of the closest parent path.
     *
     * @param string $path             The path to initialize.
     * @param array  $parentReferences The defined references for parent paths,
     *                                 with long paths /a/b sorted before short
     *                                 paths /a.
     */
    private function initWithParentOrder($path, array $parentReferences)
    {
        foreach ($parentReferences as $parentPath => $_) {
            // Look for the first parent entry for which an order is defined
            if (isset($this->json['_order'][$parentPath])) {
                // Inherit that order
                $this->json['_order'][$path] = $this->json['_order'][$parentPath];

                return;
            }
        }
    }

    /**
     * Initializes the order of a path with the default order.
     *
     * This is necessary if we want to insert a non-default order entry for
     * the first time.
     *
     * @param string $path         The path to initialize.
     * @param string $insertedPath The path that is being inserted.
     * @param array  $references   The references for each defined path mapping
     *                             in the path chain.
     */
    private function initWithDefaultOrder($path, $insertedPath, $references)
    {
        $this->json['_order'][$path] = array();

        // Insert the default order, if none exists
        // i.e. long paths /a/b/c before short paths /a/b
        $parentPath = $path;

        while (true) {
            if (isset($references[$parentPath])) {
                $parentEntry = array(
                    'path' => $parentPath,
                    'references' => count($references[$parentPath]),
                );

                // Edge case: $parentPath equals $insertedPath. In this case we have
                // to subtract the entry that we're adding
                if ($parentPath === $insertedPath) {
                    --$parentEntry['references'];
                }

                if (0 !== $parentEntry['references']) {
                    $this->json['_order'][$path][] = $parentEntry;
                }
            }

            if ('/' === $parentPath) {
                break;
            }

            $parentPath = Path::getDirectory($parentPath);
        };
    }
}
