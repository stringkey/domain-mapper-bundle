<?php

declare(strict_types=1);

namespace Stringkey\MapperBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Stringkey\MapperBundle\Repository\ContextualReferenceRepository;

/**
 * @description If you want to create an extended implementation
 *              inherit from the AbstractContextualReference
 *              By convention let the inheriting class end in ..Reference
 */

#[ORM\Entity(repositoryClass: ContextualReferenceRepository::class)]
final class ContextualReference extends AbstractContextualReference
{
    use TimestampableEntity;
}
