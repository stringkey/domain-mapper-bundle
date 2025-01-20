<?php

namespace Stringkey\MapperBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Stringkey\MapperBundle\Entity\MappableEntity;
use Stringkey\MapperBundle\Interface\MappableEntityInterface;
use Stringkey\MapperBundle\Registry\MappableEntityRegistry;
use Stringkey\MapperBundle\Repository\MappableEntityRepository;

class MapperService
{
    public function __construct(
        private readonly MappableEntityRepository $mappableEntityRepository,
        private readonly MappableEntityRegistry $mappableEntityRegistry,
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function updateEntityMapping(): void
    {
        // get the objects indexed by the fullyQualifiedClassName
        $entities = $this->mappableEntityRegistry->getEntities();

        // get the objects based on the ORM metadata map
        $persisted = $this->mappableEntityRepository->findAll();

        // remove the existing items from the results based on the key
        $entitiesToAdd = array_diff_key($entities, $persisted);

        /**
         * @var MappableEntityInterface $fullyQualifiedClassName
         * @var string $name
         */
        foreach ($entitiesToAdd as $fullyQualifiedClassName => $name) {
            $mappableEntity = new MappableEntity();
            $mappableEntity->setFqcn($fullyQualifiedClassName);
            $mappableEntity->setName($name);

            $this->entityManager->persist($mappableEntity);
        }

        $this->entityManager->flush();
    }

    public function getEntity(string $fqcn, string $externalReference): ?MappableEntityInterface
    {
        $this->mappableEntityRepository->getQueryBuilder();

        return null;
    }
}
