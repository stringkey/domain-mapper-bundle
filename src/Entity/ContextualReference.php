<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Stringkey\MetadataCoreBundle\Entity\Context;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ContextualReferenceRepository::class)]
abstract class ContextualReference
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Context $context = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getContext(): ?Context
    {
        return $this->context;
    }

    public function setContext(?Context $context): static
    {
        $this->context = $context;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }
}
