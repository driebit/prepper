<?php

namespace Driebit\Prepper\Cache;

use Doctrine\Common\DataFixtures\ProxyReferenceRepository;
use Driebit\Prepper\Fixture\FixtureSetInterface;

interface CacheInterface
{
    public function store(FixtureSetInterface $fixtures);

    /**
     * @param FixtureSetInterface $fixtures
     *
     * @return ProxyReferenceRepository
     */
    public function restore(FixtureSetInterface $fixtures);
}
