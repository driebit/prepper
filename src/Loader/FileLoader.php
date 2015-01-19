<?php

namespace Driebit\Prepper\Loader;

use Traversable;

/**
 * Loads directories holding fixture files from the filesystem
 */
class FileLoader implements LoaderInterface
{
    public function __construct(array $directories)
    {
        $this->directories = $directories;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->directories);
    }
}
