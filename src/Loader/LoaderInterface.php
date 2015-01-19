<?php

namespace Driebit\Prepper\Loader;

use Driebit\Prepper\Fixture\FixtureSetInterface;

/**
 * Loads fixture objects from files, arrays or other sources
 */
interface LoaderInterface
{
//    public function getReferences();

    /**
     * @return \Traversable
     */
    public function load(FixtureSetInterface $fixtures);
}
