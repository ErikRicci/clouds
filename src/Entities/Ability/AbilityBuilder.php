<?php

namespace Clouds\Entities\Ability;

class AbilityBuilder
{
    public static function fromArray(array $data): Ability
    {
        $ability = new Ability();
        $ability->setId(gak($data, 'id'));
        $ability->setName(gak($data, 'name'));
        $ability->setType(gak($data, 'type'));
        $ability->setDescription(gak($data, 'description'));

        return $ability;
    }
}