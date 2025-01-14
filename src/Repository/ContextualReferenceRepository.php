<?php

namespace Stringkey\MapperBundle\Repository;

use App\Entity\ContextualReference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Stringkey\MetadataCoreBundle\Entity\Context;
use Symfony\Bridge\Doctrine\Types\UuidType;

/**
 * @extends ServiceEntityRepository<ContextualReference>
 *
 * @method ContextualReference|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContextualReference|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContextualReference[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContextualReferenceRepository extends ServiceEntityRepository
{
    public const ALIAS = 'contextualReference';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContextualReference::class);
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder(self::ALIAS);
    }

    public function findAll(): array
    {
        $queryBuilder = $this->getQueryBuilder();

        return $queryBuilder->getQuery()->getResult();
    }

    public static function addContextFilter(QueryBuilder $queryBuilder, Context $context): void
    {
        $queryBuilder->andWhere(self::ALIAS.'.context = :context');
        $queryBuilder->setParameter('context', $context->getId(), UuidType::NAME);
    }
}
