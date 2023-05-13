<?php

namespace Clouds\Entities\Follower;

use Clouds\Commons\Stream;
use Clouds\Entities\Follower\Repository\GetFollowersCount;
use Clouds\Entities\Follower\Repository\InsertBulkFollowersForGod;

class FollowerRepository
{
    public static function insertStreamOfFollowersForGod($god_id, Stream $stream): void
    {
        (new InsertBulkFollowersForGod())->execute($god_id, $stream);
    }

    public static function getFollowersCount(): int
    {
        return (new GetFollowersCount())->execute();
    }
}