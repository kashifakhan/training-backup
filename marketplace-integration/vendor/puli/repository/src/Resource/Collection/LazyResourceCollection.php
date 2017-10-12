<?php

/*
 * This file is part of the puli/repository package.
 *
 * (c) Bernhard Schussek <bschussek@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Puli\Repository\Resource\Collection;

use BadMethodCallException;
use IteratorAggregate;
use OutOfBoundsException;
use Puli\Repository\Api\Resource\PuliResource;
use Puli\Repository\Api\ResourceCollection;
use Puli\Repository\Api\ResourceRepository;
use Puli\Repository\Resource\Iterator\ResourceCollectionIterator;
use Traversable;

/**
 * A resource collection which loads its resources on demand.
 *
 * This collection is read-only. Each resource is loaded when it is accessed
 * for the first time.
 *
 * @since  1.0
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class LazyResourceCollection implements IteratorAggregate, ResourceCollection
{
    /**
     * @var string[]|PuliResource[]
     */
    private $resources;

    /**
     * @var ResourceRepository
     */
    private $repo;

    /**
     * @var bool
     */
    private $loaded = false;

    /**
     * Creates a new collection.
     *
     * @param ResourceRepository $repo  The repository that will be used to load
     *                                  the resources.
     * @param array              $paths The paths of the resources which will be
     *                                  loaded into the collection.
     */
    public function __construct(ResourceRepository $repo, array $paths)
    {
        $this->resources = $paths;
        $this->repo = $repo;
    }

    /**
     * Not supported.
     *
     * @param PuliResource $resource The resource to add.
     *
     * @throws BadMethodCallException The collection is read-only.
     */
    public function add(PuliResource $resource)
    {
        throw new BadMethodCallException(
            'Lazy resource collections cannot be modified.'
        );
    }

    /**
     * Not supported.
     *
     * @param int          $key      The collection key.
     * @param PuliResource $resource The resource to add.
     *
     * @throws BadMethodCallException The collection is read-only.
     */
    public function set($key, PuliResource $resource)
    {
        throw new BadMethodCallException(
            'Lazy resource collections cannot be modified.'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        if (!isset($this->resources[$key])) {
            throw new OutOfBoundsException(sprintf(
                'The offset "%s" does not exist.',
                $key
            ));
        }

        if (!$this->resources[$key] instanceof PuliResource) {
            $this->resources[$key] = $this->repo->get($this->resources[$key]);
        }

        return $this->resources[$key];
    }

    /**
     * Not supported.
     *
     * @param string $key The collection key to remove.
     *
     * @throws BadMethodCallException The collection is read-only.
     */
    public function remove($key)
    {
        throw new BadMethodCallException(
            'Lazy resource collections cannot be modified.'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function has($key)
    {
        return isset($this->resources[$key]);
    }

    /**
     * Not supported.
     *
     * @throws BadMethodCallException The collection is read-only.
     */
    public function clear()
    {
        throw new BadMethodCallException(
            'Lazy resource collections cannot be modified.'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function keys()
    {
        if (!$this->loaded) {
            $this->load();
        }

        return array_keys($this->resources);
    }

    /**
     * Not supported.
     *
     * @param PuliResource[]|Traversable $resources The resources to replace the
     *                                              collection contents with.
     *
     * @throws BadMethodCallException The collection is read-only.
     */
    public function replace($resources)
    {
        throw new BadMethodCallException(
            'Lazy resource collections cannot be modified.'
        );
    }

    /**
     * Not supported.
     *
     * @param PuliResource[]|Traversable $resources The resources to merge into
     *                                              the collection.
     *
     * @throws BadMethodCallException The collection is read-only.
     */
    public function merge($resources)
    {
        throw new BadMethodCallException(
            'Lazy resource collections cannot be modified.'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return 0 === count($this->resources);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * Not supported.
     *
     * @param string       $key      The collection key to set.
     * @param PuliResource $resource The resource to set.
     *
     * @throws BadMethodCallException The collection is read-only.
     */
    public function offsetSet($key, $resource)
    {
        throw new BadMethodCallException(
            'Lazy resource collections cannot be modified.'
        );
    }

    /**
     * Not supported.
     *
     * @param string $key The collection key to remove.
     *
     * @throws BadMethodCallException The collection is read-only.
     */
    public function offsetUnset($key)
    {
        throw new BadMethodCallException(
            'Lazy resource collections cannot be modified.'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getPaths()
    {
        if (!$this->loaded) {
            $this->load();
        }

        return array_map(
            function (PuliResource $resource) { return $resource->getPath(); },
            $this->resources
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getNames()
    {
        if (!$this->loaded) {
            $this->load();
        }

        return array_map(
            function (PuliResource $resource) { return $resource->getName(); },
            $this->resources
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator($mode = ResourceCollectionIterator::KEY_AS_CURSOR)
    {
        if (!$this->loaded) {
            $this->load();
        }

        return new ResourceCollectionIterator($this, $mode);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        if (!$this->loaded) {
            $this->load();
        }

        return $this->resources;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->resources);
    }

    /**
     * Loads the complete collection.
     */
    private function load()
    {
        foreach ($this->resources as $key => $resource) {
            if (!$resource instanceof PuliResource) {
                $this->resources[$key] = $this->repo->get($resource);
            }
        }

        $this->loaded = true;
    }
}
