<?php

namespace Clouds\Entities\Realm\Builder;

use Clouds\Entities\Realm\Realm;

class RealmBuilder
{
    public static function fromArray(array $data): Realm
    {
        $realm = new Realm();
        $realm->setId(gak($data, 'id'));
        $realm->setName(gak($data, 'name'));

        return $realm;
    }
}