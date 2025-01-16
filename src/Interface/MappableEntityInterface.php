<?php

declare(strict_types=1);

namespace Stringkey\MapperBundle\Interface;

use Symfony\Component\Uid\Uuid;

interface MappableEntityInterface
{
    public function getId(): Uuid|int;

    /**
     * Returns a human understandable string representation, identifying the instance of the entity
     */
    public function getInstanceName(): string;

    /**
     * Returns a human understandable string representation, identifying the static entity class name
     */
    public static function getEntityName(): string;
}
