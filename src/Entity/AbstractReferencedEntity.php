<?php

namespace Stringkey\MapperBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var Collection<int, ContextualReference>
     */
    #[ORM\JoinTable()]
    #[ORM\JoinColumn(referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'reference_id', referencedColumnName: 'id', unique: true)]
    #[ORM\ManyToMany(targetEntity: ContextualReference::class)]
    private Collection $contextualReferences;

    public function __construct()
    {
        $this->contextualReferences = new ArrayCollection();
    }

    public function getContextualReferences(): array
    {
        return $this->contextualReferences->toArray();
    }

    public function addContextualReference(Collection $contextualReference): static
    {
        if (!$this->contextualReferences->contains($contextualReference)) {
            $this->contextualReferences->add($contextualReference);
        }

        return $this;
    }

    public function removeContextualReference(ContextualReference $contextualReference): static
    {
        $this->contextualReferences->removeElement($contextualReference);

        return $this;
    }
}