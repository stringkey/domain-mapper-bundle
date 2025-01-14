<?php

declare(strict_types=1);

namespace Stringkey\MapperBundle\Traits;

use App\Entity\ContextualReference;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

trait ContextualReferenceTrait
{
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