<?php

namespace Driebit\Prepper\Fixture;

abstract class AbstractFixtureSet implements FixtureSetInterface
{
    protected $files = array();
    protected $hash;
    protected $lastModified;

    /**
     * Constructor
     *
     * @param string[] $files
     */
    public function __construct(array $files)
    {
        $this->files = $files;
    }

    /**
     * {@inheritdoc}
     */
    public function getHash()
    {
        if (null === $this->hash) {
            $files = $this->files;

            // Sort so we same fixtures in different order get the same hash
            sort($files);

            // json_encode is faster than serialize: http://stackoverflow.com/a/7723730
            $this->hash = md5(json_encode($fixtures));
        }

        return $this->hash;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastModified()
    {
        if (null === $this->lastModified && count($this->files) > 0) {
            $mtimes = array();
            foreach ($this->files as $file) {
                $mtimes[] = filemtime($file);
            }
            sort($mtimes);
            $this->lastModified = new \DateTime('@' . $mtimes[0]);
        }

        return $this->lastModified;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->files);
    }
}
