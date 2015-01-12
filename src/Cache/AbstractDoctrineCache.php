<?php

namespace Driebit\Prepper\Cache;

use Doctrine\Common\Persistence\ObjectManager;
use Driebit\Prepper\Cache\Store\StoreInterface;
use Driebit\Prepper\Fixture\FixtureSet;

abstract class AbstractDoctrineCache implements CacheInterface
{
    protected $objectManager;
    protected $store;
    
    public function __construct(
        ObjectManager $objectManager,
        StoreInterface $store
    ) {
        $this->objectManager = $objectManager;
        $this->store = $store;
    }
    
    protected function getCacheKey(FixtureSet $fixtures)
    {
        return md5($fixtures->getHash() . serialize($this->getMetadata()));
    }
    
    protected function getMetadata()
    {
        return $this->objectManager->getMetadataFactory()->getAllMetadata();
    }
}
