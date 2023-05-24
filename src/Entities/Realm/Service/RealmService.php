<?php

namespace Clouds\Entities\Realm\Service;

use Clouds\Entities\Realm\Builder\RealmBuilder;
use Clouds\Entities\Realm\Realm;
use Clouds\Entities\Realm\RealmRepository;

class RealmService
{
    public static function getRealm(string $condition): ?Realm
    {
        return RealmRepository::getRealm($condition);
    }

    public static function createRealm(array $data): Realm
    {
        $realm_dto = RealmBuilder::fromArray($data);
        $new_realm = RealmRepository::insertRealm($realm_dto);
        if (! $new_realm) {
            throw new \Exception('Could not create Realm');
        }
        return $new_realm;
    }
}