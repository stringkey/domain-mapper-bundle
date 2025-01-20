<?php

declare(strict_types=1);

namespace Stringkey\MapperBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Stringkey\MapperBundle\Repository\ContextualReferenceRepository;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

/**
 * @description If you want to create an extended implementation
 *              inherit from the AbstractContextualReference
 *              By convention let the inheriting class end in ..Reference
 */

#[ORM\Entity(repositoryClass: ContextualReferenceRepository::class)]
final class ContextualReference extends AbstractContextualReference
{
//    #[ORM\Id]
//    #[ORM\Column(type: UuidType::NAME, unique: true)]
//    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
//    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
//    private ?Uuid $id = null;

    use TimestampableEntity;

    public function getId(): ?Uuid
    {
        return $this->id;
    }
}
