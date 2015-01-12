<?php

namespace Driebit\Prepper\Cache;

use Doctrine\Common\DataFixtures\ProxyReferenceRepository;
use Driebit\Prepper\Cache\Store\StoreInterface;
use Driebit\Prepper\Exception\BackupNotFoundException;
use Driebit\Prepper\Fixture\FixtureSet;

class ReferenceCache implements CacheInterface
{
    private $referenceRepository;
    private $store;
    
    public function __construct(
        ProxyReferenceRepository $referenceRepository,
        StoreInterface $store
    ) {
        $this->referenceRepository = $referenceRepository;
        $this->store = $store;
    }
    
    public function store(FixtureSet $fixtures)
    {
        $path = $this->store->getPath($this->getCacheKey($fixtures));
        file_put_contents($path, $this->referenceRepository->serialize());
    }

    public function restore(FixtureSet $fixtures)
    {
        $key = $this->getCacheKey($fixtures);
        
        if (!$this->store->has($key)) {
            throw new BackupNotFoundException($key);
        }
        
        $backup = $this->store->get($key);
        $this->referenceRepository->unserialize(
            file_get_contents($backup->getFilename())
        );
    }
    
    private function getCacheKey(FixtureSet $fixtures)
    {
        return $fixtures->getHash() . '-references.ser';
    }
}
