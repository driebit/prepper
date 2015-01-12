<?php

namespace Driebit\Prepper\Cache\Store;

class FileStore implements StoreInterface
{
    private $path;
    
    public function __construct($path)
    {
        $this->path = $path;
    }

    public function has($key)
    {
        return file_exists($this->getPath($key));
    }

    public function get($key)
    {
        return new FileBackup($this->getPath($key));
    }
    
    public function getPath($key)
    {
        return $this->path . DIRECTORY_SEPARATOR . $key;
    }
}
