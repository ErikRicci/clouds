<?php

namespace Clouds\Entities\Follower\Service;

use Clouds\Entities\Follower\FollowerRepository;

class FollowerService
{
    public static function getFollowersCount(): int
    {
        return FollowerRepository::getFollowersCount();
    }
}