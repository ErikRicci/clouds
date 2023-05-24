<?php

namespace Clouds\Database\Seeders;

use Clouds\Commons\Seeder;
use Clouds\Entities\God\Enums\Alignment;
use Clouds\Entities\Realm\Service\RealmService;

class GodSeeder implements Seeder
{
    public static function generate(int $quantity): array
    {
        $gods_generated = [];
        for ($i = 0; $i < $quantity; $i++) {
            $gods_generated[] = [
                'name' => 'God'.rand(1000, 9999),
                'realm_id' => RealmService::getRealm('1 = 1 ORDER BY RAND()')->getId(),
                'alignment' => Alignment::cases()[rand(0, sizeof(Alignment::cases()) - 1)]->value
            ];
        }

        return $gods_generated;
    }
}