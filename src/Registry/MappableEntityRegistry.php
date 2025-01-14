<?php

namespace Stringkey\MapperBundle\Registry;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Stringkey\MapperBundle\Entity\MappableEntity;
use Stringkey\MapperBundle\Interface\MappableEntityInterface;

class MappableEntityRegistry
{
    /** @var MappableEntityInterface[] */
    private iterable $mappableEntities = [];

    private bool $isCached = false;

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {

    }

    public function has(string $className): bool
    {
        if (!$this->isCached) {
            $this->init();
        }
        return isset($this->mappableEntities[$className]);
    }

    public function get(string $className): ?string
    {
        if ($this->has($className)) {
            return $this->mappableEntities[$className];
        }
        return null;
    }

    public function init(): void
    {
        $allMetadata =$this->entityManager->getMetadataFactory()->getAllMetadata();

        /** @var ClassMetadata $classMetadata */
        foreach ($allMetadata as $classMetadata) {
            $className = $classMetadata->getName();

            if ((is_subclass_of($className, MappableEntityInterface::class, true))) {
                $this->mappableEntities[$className] = $className::getGroupName();
            }
        }

        $this->isCached = true;
    }

    public function getEntities(): array
    {
        if (!$this->isCached) {
            $this->init();
        }
        return $this->mappableEntities;
    }

    public function getOptions(): array
    {
        return array_flip($this->mappableEntities);
    }
}
