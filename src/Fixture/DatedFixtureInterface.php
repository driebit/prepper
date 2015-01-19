<?php

namespace Driebit\Prepper\Fixture;

interface DatedFixtureInterface
{
    /**
     * @return \DateTime
     */
    public function getLastModified();
}
