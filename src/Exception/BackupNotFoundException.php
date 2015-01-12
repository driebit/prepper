<?php

namespace Driebit\Prepper\Exception;

class BackupNotFoundException extends \RuntimeException
{
    public function __construct($filename)
    {
        parent::__construct(sprintf('Backup file %s does not exist', $filename));
    }
}
