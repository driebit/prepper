<?php

namespace Driebit\Prepper\Persister;

use Driebit\Prepper\Loader\FileLoader;
use Driebit\Prepper\Loader\LoaderInterface;
use Symfony\Component\Filesystem\Filesystem;

class FilePersister implements PersisterInterface
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function persist(LoaderInterface $loader)
    {
        $filesystem = new Filesystem();
        foreach ($loader as $directory) {
            $filesystem->mirror($directory, $this->targetDirectory);
        }
    }

    public function supports(LoaderInterface $loader)
    {
        return $loader instanceof FileLoader;
    }
}
