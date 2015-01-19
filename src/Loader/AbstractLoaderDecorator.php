<?php

namespace Driebit\Prepper\Loader;

abstract class AbstractLoaderDecorator implements LoaderInterface
{
    protected $loader;

    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }
}
