<?php

namespace Stringkey\MapperBundle\Interface;

interface MappableEntityInterface
{
    public function getId();

    /**
     * Expecting the name, which is going to be updated in Master Options
     *
     * @return string
     */
    public function getLabel();

    /**
     * Expecting OptionGroupName of the specific entity
     *
     * @return string
     */
    public static function getGroupName();
}