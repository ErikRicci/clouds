<?php

namespace Clouds\Entities\God\Service;

use Clouds\Entities\Follower\FollowerRepository;
use Clouds\Entities\God\Stream\GodFollowerStream;

class GodFollowerService
{
    public static function getFollowersForGod(int $god_id): GodFollowerStream
    {
        return new GodFollowerStream(
            [
                ['name' => 'Erik', 'surname' => 'Araujo Riccioppo'],
                ['name' => 'Luiza', 'surname' => 'Portugal Merino'],
                ['name' => 'Erik', 'surname' => 'Caramujo Rachacoco']
            ],
            $god_id
        );
    }

    public static function generateFollowersForGod(int $god_id, int $followers_to_generate): void
    {
        $stream = GodFollowerStream::empty();
        for ($i = 0; $i < $followers_to_generate; $i++) {
            $stream->push(self::generateFollower());
        }
        FollowerRepository::insertStreamOfFollowersForGod($god_id, $stream);
    }

    private static function generateFollower(): array
    {
        return [
            'name' => 'Luiza' . rand(0, 100) . '-' . rand(0, 1000)
        ];
    }
}
