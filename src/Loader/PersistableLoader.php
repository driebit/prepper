<?php

namespace Driebit\Prepper\Loader;

use Driebit\Prepper\Fixture\FixtureSetInterface;
use Driebit\Prepper\Persister\PersisterInterface;

class PersistableLoader implements LoaderInterface
{
    protected $loader;
    protected $persister;

    public function __construct(
        LoaderInterface $loader,
        PersisterInterface $persister
    ) {
        $this->loader = $loader;
        $this->persister = $persister;

    }

    public function load(FixtureSetInterface $fixtures)
    {
        $this->loader->load($fixtures);
        $this->persister->persist($this->loader);
    }
}
