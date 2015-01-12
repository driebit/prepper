<?php

namespace Driebit\Prepper\FixtureLoader;

use Doctrine\Common\DataFixtures\ProxyReferenceRepository;
use Driebit\Prepper\Fixture\FixtureSet;

interface FixtureLoaderInterface
{
    /**
     * @param FixtureSet $fixtures
     *
     * @return ProxyReferenceRepository
     */
    public function load(FixtureSet $fixtures);
}
