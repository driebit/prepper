<?php

namespace Driebit\Prepper\Exception;

class BackupOutOfDateException extends \RuntimeException
{
    public function __construct($filename)
    {
        parent::__construct(
            sprintf('Backup %s is out of date', $filename)
        );
    }
    
}
