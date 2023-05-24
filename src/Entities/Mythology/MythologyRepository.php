<?php

namespace Clouds\Entities\Mythology;

use Clouds\Entities\Mythology\Repository\GetTopMythologiesByFollowers;

class MythologyRepository
{
    /** @return Mythology[] */
    public static function getAllMythologiesWithGods(string $order_by = null): array
    {
        return (new GetAllMythologiesWithGods())->execute($order_by);
    }

    public static function getTopMythologiesByFollowers(int $quantity_to_fetch): array
    {
        return (new GetTopMythologiesByFollowers())->execute($quantity_to_fetch);
    }
}
