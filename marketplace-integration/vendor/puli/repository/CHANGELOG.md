Changelog
=========

* 1.0.0-beta9 (2016-01-14)

 * made compatible with Symfony 3.0
 * added JSON schema for path mapping files: `path-mappings-schema-1.0.json`
 * upgraded to webmozart/glob 4.1 to improve performance
 * renamed `Resource` to `PuliResource`
 * renamed `AbstractPathMappingRepository` to `AbstractJsonRepository`
 * renamed `PathMappingRepository` to `JsonRepository`
 * renamed `OptimizedPathMappingRepository` to `OptimizedJsonRepository`
 * changed constructor arguments of JSON repositories from `KeyValueStore`
   to paths of JSON files
 * added `AbstractEditableRepository`
 * added `ChangeStream`
 * added `VersionList`
 * added `NoVersionFoundException`
 * added `InMemoryChangeStream`
 * added `KeyValueStoreChangeStream`
 * added `JsonChangeStream`
 * added `PuliResource::getVersions()`
 * added `ResourceRepository::getVersions()`
 * added `LinkResource::getTarget()`
 * made `LinkResource` serializable

* 1.0.0-beta8 (2015-10-05)

 * fixed problem with slash handling in `PathMappingRepository`
 * added `LinkResource`

* 1.0.0-beta7 (2015-08-24)

 * improved Windows compatibility
 * fixed minimum package versions in composer.json
 * switched to webmozart/glob 3.1 to fix Windows issues
 * fixed resource overriding in the `PathMappingRepository`
 * supported removal of path mappings in `PathMappingRepository`

* 1.0.0-beta6 (2015-08-12)

 * added `PathMappingRepository`
 * added `OptimizedPathMappingRepository`
 * fixed repository building on Windows
 * upgraded to webmozart/glob 3.0 for enhanced performance of file iteration
 * added `AbstractRepository` and `AbstractPathMappingRepository`
 * fixed reading of file modification time for symlinks

* 1.0.0-beta5 (2015-05-29)

 * upgraded to webmozart/path-util 2.0
 * fixed overriding of files in deep directories

* 1.0.0-beta4 (2015-04-13)

 * removed `Resource::getPayload()`
 * removed `$code` arguments from static exception factory methods
 * upgraded to webmozart/glob 2.0

* 1.0.0-beta3 (2015-03-19)

 * added `Resource::getPayload()`
 * removed `DetachedException`
 * replaced `Assert` by webmozart/assert
 * added support for relative symlinks to `FilesystemRepository`
 * `FilesystemRepository` now falls back to copies if symlinks are not supported

* 1.0.0-beta2 (2015-01-27)

 * added `NullRepository`
 * removed dependency to beberlei/assert
 * symfony/filesystem is now an optional dependency that is only needed when
   using the FilesystemRepository

* 1.0.0-beta (2015-01-12)

 * renamed `Selector` to `Glob` and moved it to package "webmozart/glob"
 * removed `AttachableResourceInterface`
 * removed `DirectoryResourceInterface`
 * removed `FileResourceInterface`
 * removed `OverriddenPathLoaderInterface`
 * removed `Interface` suffix of all interfaces
 * `ResourceRepository::find()` now matches directory separators "/" when given
   a wildcard "*"
 * merged `AbstractResource` and `DirectoryResource` into `GenericResource`
 * renamed `LocalDirectoryResource` to `DirectoryResource`
 * renamed `LocalFileResource` to `FileResource`
 * removed `LocalResource::getAllLocalPaths`
 * rename `LocalResource::getLocalPath` to `LocalResource::getFilesystemPath`
 * renamed `LocalResource` to `FilesystemResource`
 * renamed `LocalResourceCollection` to `FilesystemResourceCollection`
 * removed `createAttached()` from `GenericResource`, `FileResource` and
   `DirectoryResource`
 * removed tagging
 * renamed`ResourceRepository` to `InMemoryRepository`
 * renamed `ResourceCollection` to `ArrayResourceCollection`
 * renamed `RecursiveResourceIterator` to `RecursiveResourceIteratorIterator`
 * renamed `ManageableResourceRepository` to `EditableRepository`
 * removed `UriRepository`
 * added `$scheme` argument to `ResourceStreamWrapper::register()` and
   `ResourceStreamWrapper::unregister()`
 * added `ResourceNotFoundException::forPath()`
 * added `NoDirectoryException::forPath()`
 * moved contents of `Puli\Repository\Filesystem\Iterator` to `Puli\Repository\Iterator`
 * moved contents of `Puli\Repository\Filesystem\Resource` to `Puli\Repository\Resource`
 * moved `FilesystemRepository` to `Puli\Repository`
 * removed `PhpCacheRepository`
 * added domain-specific `Assert` class
 * moved API interfaces to `Api` sub-namespace
 * removed notions of "directories" and "files". All resources can have children
   and a body now.
 * added `ResourceRepository::listChildren()` and `hasChildren()`
 * added `ResourceMetadata` and `FilesystemMetadata`
 * added methods to `Resource`:
   * `getChild()`
   * `hasChild()`
   * `hasChildren()`
   * `listChildren()`
   * `getMetadata()`
   * `getRepository()`
   * `getRepositoryPath()`
   * `attachTo()`
   * `detach()`
   * `isAttached()`
   * `createReference()`
   * `isReference()`
 * made `Resource` extend `Serializable`
 * added `EditableRepository::clear()`
 * removed backend repositories from `InMemoryRepository` and `FilesystemRepository`
 * added symlink support to `FilesystemRepository`
 * removed `FilesystemException`
 * removed `InvalidPathException`
 * removed `UnsupportedSchemeException`
 * replaced `NoDirectoryException` by `UnsupportedOperationException`
 * removed `CompositeRepository` from the 1.0 branch

* 1.0.0-alpha4 (2014-12-03)

 * moved extensions to separate repositories in https://github.com/puli
 * moved documentation to separate repository: https://github.com/puli/docs
 * moved `Path` to "webmozart/path-util" package
 * moved all code to `Puli\Repository` namespace
 * rearranged the directory structure
 * added `ResourceCollectionIterator`
 * added `ResourceIteratorInterface`
 * added `RecursiveResourceIterator`
 * added `RecursiveResourceIteratorInterface`
 * added `ResourceFilterIterator`
 * renamed `ResourceRepositoryInterface` to `ManageableRepositoryInterface`
 * renamed `ResourceLocatorInterface` to `ResourceRepositoryInterface`
 * renamed all "locators" to "repositories"
 * moved all filesystem specific code to `Filesystem` namespace
 * made `ResourceInterface` independent of the filesystem. The filesystem
   specific methods are now in `LocalResourceInterface`
 * `getAlternativePaths()` is now called `getAllLocalPaths()`
 * added `getContents()`, `getSize()`, `getLastAccessedAt()` and
   `getLastModifiedAt()` to `FileResourceInterface`
 * removed all pattern-related classes. This logic is now provided by the
   `Selector` class
 * `ResourceRepository::remove()`, `tag()` and `untag()` now return the number
   of affected resources
 * added `UriRepository::getDefaultScheme()` and `setDefaultScheme()`
 * renamed `getByTag()` to `findByTag()`
 * added `merge()` to `ResourceCollectionInterface`
 * added `CompositeRepository`
 * removed `LazyDirectoryResource`
 * fixed ResourceRepository::add() to be deterministic when selectors are passed. Closes #17

* 1.0.0-alpha3 (2014-02-22)

 * renamed `PhpResourceLocator` to `PhpCacheLocator`
 * renamed `PhpResourceLocatorDumper` to `PhpCacheDumper`
 * added `FilesystemLocator`
 * removed `ResourceDiscoveringInterface`
 * a base `ResourceLocatorInterface` can now be passed to `ResourceRepository`
 * instead of arrays, `ResourceCollection` objects are now returned everywhere
 * renamed `ResourceInterface::getPath()` to `getRealPath()`
 * renamed `ResourceInterface::getRepositoryPath()` to `getPath()`
 * added an extension for the templating engine Twig
 * added an extension for the Symfony Config and HttpKernel components

* 1.0.0-alpha2 (2014-02-14)

 * fixed "Maximum function nesting level" error on Windows
 * pushed minimum PHP version to 5.3.9
 * removed `TagInterface` and descending classes
 * added support for dot segments ("." and "..")
 * removed `CreationNotAllowedException`
 * removed `RemoveNotAllowedException`
 * removed `RenameNotAllowedException`
 * added `UnsupportedOperationException`
 * added `Path`
 * added `Uri`
 * added `UriLocatorInterface` and `UriLocator`
 * changed `ResourceStreamWrapper::register()` to take a `UriLocatorInterface`
   instance instead of a scheme and a resource locator

* 1.0.0-alpha1 (2014-02-04)

 * first alpha release
