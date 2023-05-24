<?php

namespace Clouds\Controllers;

use Clouds\Entities\Realm\Service\RealmService;
use R2SSimpleRouter\Request;
use R2SSimpleRouter\Response;

class RealmController
{
    public function store()
    {
        $realm = RealmService::createRealm(Request::all());

        Response::success([
            'realm' => $realm
        ]);
    }

    public function show(int $realmId)
    {
        $realm = RealmService::getRealm("id = $realmId");

        Response::success([
            'realm' => $realm,
            'realm_id' => $realmId,
        ]);
    }
}