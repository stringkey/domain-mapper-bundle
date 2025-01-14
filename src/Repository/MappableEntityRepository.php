<?php

declare(strict_types=1);

namespace Stringkey\MapperBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Stringkey\MapperBundle\Entity\MappableEntity;

/**
 * @extends ServiceEntityRepository<MappableEntity>
 *
 * @method MappableEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method MappableEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method MappableEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MappableEntityRepository extends ServiceEntityRepository
{
    public const ALIAS = 'mappableEntity';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MappableEntity::class);
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder(self::ALIAS);
    }

    /**
     * @throws QueryException
     */
    public function findAll(): array
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->indexBy(self::ALIAS, self::ALIAS.'.fullyQualifiedClassName');

        return $queryBuilder->getQuery()->getResult();
    }

    public function findByFQCN(string $fqcn): ?MappableEntity
    {
        $queryBuilder = $this->getQueryBuilder();
        self::addFqcnFilter($queryBuilder, $fqcn);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    private static function addFqcnFilter(QueryBuilder $queryBuilder, string $fqcn): void
    {
        $queryBuilder->andWhere(self::ALIAS.'.fullyQualifiedClassName = :fqcn');
        $queryBuilder->setParameter('fqcn', $fqcn);
    }
}
