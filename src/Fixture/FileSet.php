<?php

namespace Driebit\Prepper\Fixture;

class FileSet implements FixtureSetInterface
{
    private $files;
    private $lastModified;
    private $hash;

    public function __construct(array $files)
    {
        $this->files = $files;
    }

    public function getHash()
    {
        if (null === $this->hash) {
            $files = $this->files;

            // Sort so we same fixtures in different order get the same hash
            sort($files);

            // json_encode is faster than serialize: http://stackoverflow.com/a/7723730
            $this->hash = md5(json_encode($files));
        }

        return $this->hash;
    }

    public function getLastModified()
    {
        if (null === $this->lastModified) {
            $mtimes = array();

            foreach ($this->files as $file) {
                $mtimes[] = filemtime($file);
            }

            // Look at the fixture that was modified last
            sort($mtimes);
            $this->lastModified = new \DateTime('@' . $mtimes[0]);
        }

        return $this->lastModified;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->files);
    }
}
