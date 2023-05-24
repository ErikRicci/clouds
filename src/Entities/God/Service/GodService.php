<?php

namespace Clouds\Entities\God\Service;

use Clouds\Database\Seeders\GodSeeder;
use Clouds\Entities\God\God;
use Clouds\Entities\God\GodBuilder;
use Clouds\Entities\God\GodRepository;
use Clouds\Entities\God\Stream\GodStream;

class GodService
{
    /** @return God[] */
    public static function getAllGods(string $order_by = null): array
    {
        return GodRepository::getAllGods($order_by);
    }

    public static function getGodsCount(): int
    {
        return GodRepository::getGodsCount();
    }

    public static function generateGods(int $quantity)
    {
        $gods = GodSeeder::generate($quantity);
        GodRepository::insertBulkGods($gods);

        return GodStream::with($gods);
    }

    public static function createGod(array $data): God
    {
        $god_dto = GodBuilder::fromArray($data);
        $new_god = GodRepository::insertGod($god_dto);
        if (! $new_god) {
            throw new \Exception('Could not create God');
        }
        return $new_god;
    }

    public static function getGodsWithAbilities(): array
    {
        return GodRepository::getGodsWithAbilities();
    }
}
