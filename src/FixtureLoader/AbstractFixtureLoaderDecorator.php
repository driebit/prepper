<?php

namespace Driebit\Prepper\FixtureLoader;

abstract class AbstractFixtureLoaderDecorator implements FixtureLoaderInterface
{
    protected $loader;
    
    public function __construct(FixtureLoaderInterface $loader)
    {
        $this->loader = $loader;
    }
}
