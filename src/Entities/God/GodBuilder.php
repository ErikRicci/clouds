<?php

namespace Clouds\Entities\God;

use Clouds\Entities\Mythology\MythologyBuilder;

class GodBuilder
{
    public static function fromArray(array $data): God
    {
        $god = new God();
        $god->setId(gak($data, 'id'));
        $god->setName(gak($data, 'name'));
        $god->setRealmId(gak($data, 'realm_id'));
        $god->setAlignment(gak($data, 'alignment'));
        $god->setCreatedAt(gak($data, 'created_at', now()));

        return $god;
    }
}
