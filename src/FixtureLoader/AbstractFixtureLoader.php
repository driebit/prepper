<?php

namespace Driebit\Prepper\FixtureLoader;

use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\ProxyReferenceRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Driebit\Prepper\Fixture\FixtureSet;
use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractFixtureLoader implements FixtureLoaderInterface
{
    protected $container;
    protected $objectManager;
    protected $referenceRepository;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;

        return $this;
    }

    public function setReferenceRepository(
        ProxyReferenceRepository $referenceRepository
    ) {
        $this->referenceRepository = $referenceRepository;

        return $this;
    }

    public function load(FixtureSet $fixtures)
    {
        if ($this->container) {
            $loader = new ContainerAwareLoader($this->container);
        } else {
            $loader = new Loader();
        }

        foreach ($fixtures as $fixture) {
            $loader->addFixture($fixture);
        }

        // Find backup for fixtures
        $executor = $this->getExecutor($this->objectManager);

        $executor->setReferenceRepository($this->referenceRepository);

        // Set append to true to prevent exception about missing purger
        $executor->execute($loader->getFixtures(), true);

        return $this->referenceRepository;
    }

    abstract protected function getExecutor(ObjectManager $objectManager);
}
