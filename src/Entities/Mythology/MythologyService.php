<?php

namespace Clouds\Entities\Mythology;

class MythologyService
{
    /** @return Mythology[] */
    public static function getAllMythologiesWithGods(string $order_by = null): array
    {
        return MythologyRepository::getAllMythologiesWithGods($order_by);
    }

    public static function getTopMythologiesByFollowers(int $quantity_to_fetch): array
    {
        return MythologyRepository::getTopMythologiesByFollowers($quantity_to_fetch);
    }
}
