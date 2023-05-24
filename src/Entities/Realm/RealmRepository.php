<?php

namespace Clouds\Entities\Realm;

use Clouds\Commons\Repository;
use Clouds\Entities\Realm\Builder\RealmBuilder;
use Clouds\Entities\Realm\Stream\RealmStream;

class RealmRepository extends Repository
{
    public static function getRealm(string $condition): ?Realm
    {
        $result = parent::forTable('realms')->firstWhere($condition);

        return $result
            ? RealmBuilder::fromArray($result)
            : null;
    }

    public static function insertRealm(Realm $realm): Realm|false
    {
        return parent::forTable('realms')->insert($realm);
    }
}