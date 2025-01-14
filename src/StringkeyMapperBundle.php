<?php

namespace Stringkey\MapperBundle;

use Stringkey\MapperBundle\DependencyInjection\StringkeyMapperExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class StringkeyMapperBundle extends Bundle
{
    /**
     * Overridden to allow for the custom extension alias.
     */
    public function getContainerExtension(): ExtensionInterface|null
    {
        if (null === $this->extension) {
            $this->extension = new StringkeyMapperExtension();
        }
        return $this->extension;
    }
}