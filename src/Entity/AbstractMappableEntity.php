<?php

namespace Stringkey\MapperBundle\Entity;

use Stringkey\EntityMapperBundle\Interface\MappableEntityInterface;
use Symfony\Component\Uid\Uuid;

abstract class AbstractMappableEntity implements MappableEntityInterface
{
    abstract public function getId(): Uuid|int;

    abstract public function getInstanceName(): string;

    public static function getEntityName(): string
    {
        return get_called_class();
    }
}