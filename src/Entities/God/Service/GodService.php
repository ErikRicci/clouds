<?php

namespace Clouds\Entities\God\Service;

use Clouds\Entities\God\God;
use Clouds\Entities\God\GodRepository;

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
}
