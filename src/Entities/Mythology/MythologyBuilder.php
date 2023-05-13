<?php

namespace Clouds\Entities\Mythology;

class MythologyBuilder
{
    public static function fromArray(array $data): Mythology
    {
        $mythology = new Mythology();
        $mythology->setId(gak($data, 'id'));
        $mythology->setName(gak($data, 'name'));

        return $mythology;
    }
}
