<?php

namespace Driebit\Prepper\FixtureLoader;

use Driebit\Prepper\Fixture\FixtureSet;
use Driebit\Prepper\Resetter\ResetterInterface;

class ResettableFixtureLoader extends AbstractFixtureLoaderDecorator
{
    private $resetter;
    
    public function __construct(
        FixtureLoaderInterface $loader,
        ResetterInterface $resetter
    ) {
        $this->resetter = $resetter;
        parent::__construct($loader);
    }
    
    public function addResetter(ResetterInterface $resetter)
    {
        $this->resetters[] = $resetter;
    }

    public function load(FixtureSet $fixtures)
    {
        $this->resetter->reset();

        return $this->loader->load($fixtures);
    }
}
