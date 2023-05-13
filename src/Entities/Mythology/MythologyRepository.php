<?php

namespace Clouds\Entities\Mythology;

class MythologyRepository
{
    /** @return Mythology[] */
    public static function getAllMythologiesWithGods(string $order_by = null): array
    {
        return (new GetAllMythologiesWithGods())->execute($order_by);
    }
}
