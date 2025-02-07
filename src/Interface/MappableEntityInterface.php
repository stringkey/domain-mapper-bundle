<?php

declare(strict_types=1);

namespace Stringkey\MapperBundle\Interface;

use Symfony\Component\Uid\Uuid;

/**
 * This interface is used to flag that an entity is mappable
 * When using the MappableEntityRegistry, all entities managed by doctrine are listed
 * The entity name is used to name the groups of the entities
 * An instance of an entity is being mapped with a record within a group
 * The group has a reference to the domain object type (fully qualified class name)
 * The option with in the group has a label and an identifier within that group.
 */

interface MappableEntityInterface
{
    public function getId(): Uuid|int|null;

    /**
     * Returns a human understandable string representation, identifying the instance of the entity
     */
    public function getInstanceName(): string;

    /**
     * Returns a human understandable string representation, identifying the static entity class name
     */
    public static function getEntityName(): string;
}
