<?php

namespace Driebit\Prepper\Loader;

use Driebit\Prepper\Fixture\FixtureSet;
use Driebit\Prepper\Fixture\FixtureSetInterface;
use Driebit\Prepper\Resetter\ResetterInterface;

class ResettableLoader extends AbstractLoaderDecorator
{
    private $resetter;

    public function __construct(
        LoaderInterface $loader,
        ResetterInterface $resetter
    ) {
        $this->resetter = $resetter;
        parent::__construct($loader);
    }

    public function addResetter(ResetterInterface $resetter)
    {
        $this->resetters[] = $resetter;
    }

    public function load(FixtureSetInterface $fixtures)
    {
        $this->resetter->reset();

        return $this->loader->load($fixtures);
    }
}
