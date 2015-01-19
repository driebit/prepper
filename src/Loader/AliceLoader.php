<?php

namespace Driebit\Prepper\Loader;

use Driebit\Prepper\Alice\FixtureSet;
use Driebit\Prepper\Fixture\FixtureSetInterface;
use Nelmio\Alice\Fixtures;
use Nelmio\Alice\Fixtures\Loader;
use Traversable;
use Nelmio\Alice\Loader\Yaml;

/**
 * Loads fixtures from Alice YAML files
 */
class AliceLoader implements LoaderInterface, \IteratorAggregate
{
    private $loader;
    private $objects = array();

    public function __construct(LoaderInterface $loader = null)
    {
        $this->loader = $loader ?: new Yaml();
    }

    /**
     * {@inheritdoc}
     */
    public function load(FixtureSetInterface $files)
    {
        foreach ($files as $file) {
            $objects = $this->loader->load($file);
            $this->objects = array_merge($this->objects, $objects);
        }
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->objects);
    }
}
