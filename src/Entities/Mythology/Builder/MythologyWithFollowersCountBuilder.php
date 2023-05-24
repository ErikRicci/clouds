<?php

namespace Clouds\Entities\Mythology\Builder;

use Clouds\Entities\Mythology\Struct\MythologyWithFollowersCount;

class MythologyWithFollowersCountBuilder
{
    public static function fromArray(array $data): MythologyWithFollowersCount
    {
        return new MythologyWithFollowersCount(
            gak($data, 'name'),
            gak($data, 'followers_count', 0)
        );
    }
}