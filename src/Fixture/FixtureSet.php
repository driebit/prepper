<?php

namespace Driebit\Prepper\Fixture;

class FixtureSet implements \IteratorAggregate
{
    private $fixtures = array();
    private $classes = array();
    private $lastModified;
    
    public function __construct($fixtures)
    {
        $this->fixtures = $fixtures;
        foreach ($fixtures as $fixture) {
            $this->classes[] = new $fixture;
        }
    }
    
    public function getHash()
    {
        $fixtures = $this->fixtures;
        
        // Sort so we same fixtures in different order get the same hash
        sort($fixtures);

        // json_encode is faster than serialize: http://stackoverflow.com/a/7723730
        return md5(json_encode($fixtures));
    }
    
    public function getLastModified()
    {
        if (null === $this->lastModified) {
            $mtimes = array();

            foreach ($this->classes as $class) {
                
                if ($class instanceof DatedFixtureInterface) {
                    // @todo
                } else {
                    // Determine last modified on file mtime
                    $reflClass = new \ReflectionClass($class);
                    $mtimes[] = filemtime($reflClass->getFileName());
                }
            }
        }

        // Look at the fixtures that was last modified
        sort($mtimes);
        $this->lastModified = new \DateTime('@' . $mtimes[0]);
        
        return $this->lastModified;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->classes);
    }
}
