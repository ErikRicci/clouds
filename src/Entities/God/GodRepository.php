<?php

namespace Clouds\Entities\God;

use Clouds\Entities\God\Repository\GetAllGods;
use Clouds\Entities\God\Repository\GetGodsCount;

class GodRepository
{
    /** @return God[] */
    public static function getAllGods(string $order_by = null): array
    {
        return (new GetAllGods())->execute($order_by);
    }

    public static function getGodsCount(): int
    {
        return (new GetGodsCount())->execute();
    }
}
