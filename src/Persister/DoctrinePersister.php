<?php

namespace Driebit\Prepper\Persister;

use Doctrine\Common\Persistence\ObjectManager;
use Driebit\Prepper\Fixture\FixtureSetInterface;
use Driebit\Prepper\Loader\LoaderInterface;
use Driebit\Prepper\Loader\ObjectLoader;

class DoctrinePersister implements PersisterInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function persist(LoaderInterface $loader)
    {
        $current = null;

        foreach ($loader as $name => $object) {
            // @todo check whether name is numeric; if not, assume reference name
            if ($current !== get_class($object)) {
                // When switching to a new object type, flush the previous one.
                $this->manager->flush();
            }
            $this->manager->persist($object);
            $current = get_class($object);
        }

        $this->manager->flush();

        return $this;
    }

    public function supports(LoaderInterface $loader)
    {
        return $loader instanceof ObjectLoader;
    }
}
