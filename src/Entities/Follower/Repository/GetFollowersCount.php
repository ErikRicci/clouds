<?php

namespace Clouds\Entities\Follower\Repository;

use Oracle\Oracle;

class GetFollowersCount
{
    public function execute(): int
    {
        $result = Oracle::getInstance()->select("SELECT COUNT(*) AS followers_count FROM followers WHERE 1 = 1");
        return $result[0]['followers_count'];
    }
}