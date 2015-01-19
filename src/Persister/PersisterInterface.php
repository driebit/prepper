<?php

namespace Driebit\Prepper\Persister;

use Driebit\Prepper\Loader\LoaderInterface;

interface PersisterInterface
{
    public function persist(LoaderInterface $loader);
    public function supports(LoaderInterface $loader);
}
