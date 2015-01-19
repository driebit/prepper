<?php

namespace Driebit\Prepper\Loader;

use Driebit\Prepper\Cache\CacheInterface;
use Driebit\Prepper\Exception\BackupNotFoundException;
use Driebit\Prepper\Exception\BackupOutOfDateException;
use Driebit\Prepper\Fixture\FixtureSetInterface;

class CacheableLoader extends AbstractLoaderDecorator
{
    private $cache;

    public function __construct(
        LoaderInterface $loader,
        CacheInterface $cache
    ) {
        $this->cache = $cache;
        parent::__construct($loader);
    }

    public function load(FixtureSetInterface $fixtures)
    {
        // check cache
        try {
            return $this->cache->restore($fixtures);
        } catch (BackupNotFoundException $e) {
            // ignore: backup will be re-created
        } catch (BackupOutOfDateException $e) {
            // ignore: backup will be re-created
        } catch (\Exception $e) {
            throw $e;
        }

        $references = $this->loader->load($fixtures);

        $this->cache->store($fixtures);

        return $references;
    }
}
