<?php

namespace Driebit\Prepper\Cache\Store;

class FileBackup
{
    private $filename;
    
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function getFilename()
    {
        return $this->filename;
    }
    
    public function getCreated()
    {
        return new \DateTime('@' . filemtime($this->filename));
    }
}
