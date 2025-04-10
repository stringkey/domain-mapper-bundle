<?php

declare(strict_types=1);

namespace Stringkey\MapperBundle\Traits;

trait ExternalReferenceTrait
{
    private string $externalReference;

    public function getExternalReference(): string
    {
        return $this->externalReference;
    }

    public function setExternalReference(string $externalReference): static
    {
        return $this->externalReference = $externalReference;
    }
}
