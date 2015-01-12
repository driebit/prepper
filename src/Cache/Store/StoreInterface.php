<?php

namespace Driebit\Prepper\Cache\Store;

interface StoreInterface
{
    public function has($key);
    public function get($key);
    public function getPath($key);
}
