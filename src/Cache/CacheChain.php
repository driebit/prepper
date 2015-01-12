<?php

namespace Driebit\Prepper\Cache;

use Driebit\Prepper\Fixture\FixtureSet;

class CacheChain implements CacheInterface
{
    /**
     * @var CacheInterface[]
     */
    private $caches = array();
    
    public function __construct(array $caches = array())
    {
        foreach ($caches as $cache) {
            $this->addCache($cache);
        }
    }
    
    public function addCache(CacheInterface $cache)
    {
        $this->caches[] = $cache;
    }
    
    public function store(FixtureSet $fixtures)
    {
        foreach ($this->caches as $cache) {
            $cache->store($fixtures);
        }
    }

    public function restore(FixtureSet $fixtures)
    {
        foreach ($this->caches as $cache) {
            $references = $cache->restore($fixtures);
        }
    }
}
