<?php

namespace Driebit\Prepper\Fixture;

/**
 * A set of data fixtures
 */
interface FixtureSetInterface extends \IteratorAggregate
{
    /**
     * Get unique hash identifying set of fixtures
     *
     * @return string
     */
    public function getHash();

    /**
     * Get last modification timestamp
     *
     * @return \DateTime
     */
    public function getLastModified();
}
