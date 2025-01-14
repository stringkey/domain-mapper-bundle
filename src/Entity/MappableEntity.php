<?php

namespace Stringkey\MapperBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Stringkey\MapperBundle\Repository\MappableEntityRepository;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: MappableEntityRepository::class)]
class MappableEntity
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $fullyQualifiedClassName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?\DateTimeImmutable $createdAt;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFullyQualifiedClassName(): ?string
    {
        return $this->fullyQualifiedClassName;
    }

    public function setFullyQualifiedClassName(string $fullyQualifiedClassName): static
    {
        $this->fullyQualifiedClassName = $fullyQualifiedClassName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
    public function __toString(): string
    {
        return $this->name;
    }
}
