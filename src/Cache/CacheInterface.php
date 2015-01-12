<?php

namespace Driebit\Prepper\Cache;

use Doctrine\Common\DataFixtures\ProxyReferenceRepository;
use Driebit\Prepper\Fixture\FixtureSet;

interface CacheInterface
{
    public function store(FixtureSet $fixtures);

    /**
     * @param FixtureSet $fixtures
     *
     * @return ProxyReferenceRepository
     */
    public function restore(FixtureSet $fixtures);
}
