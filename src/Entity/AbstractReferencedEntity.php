<?php

namespace Stringkey\MapperBundle\Entity;

use Stringkey\MapperBundle\Traits\ContextualReferenceTrait;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;

abstract class AbstractReferencedEntity
{

    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;
    public function getId(): ?Uuid
    {
        return $this->id;
    }

    /**
     * @description Creates a relation to a ContextualReference record
     */
    use ContextualReferenceTrait;

}