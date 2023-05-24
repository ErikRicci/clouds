<?php

namespace Clouds\Entities\Mythology\Repository;

use Clouds\Entities\Mythology\Builder\MythologyWithFollowersCountBuilder;
use Clouds\Entities\Mythology\Struct\MythologyWithFollowersCount;
use Oracle\Oracle;

class GetTopMythologiesByFollowers
{
    /** @return MythologyWithFollowersCount[] */
    public function execute(int $quantity_to_fetch = 3): array
    {
        $result = Oracle::getInstance()->select("
            SELECT
                COUNT(f.id) AS followers_count,
                m.name
            FROM mythologies m
                LEFT JOIN god_mythology gm ON gm.mythology_id = m.id
                LEFT JOIN gods g ON g.id = gm.god_id
                JOIN followers f ON f.god_id = g.id
            WHERE 1 = 1
            GROUP BY m.id
            ORDER BY followers_count DESC
            LIMIT $quantity_to_fetch"
        );

        return array_map(fn ($row) => MythologyWithFollowersCountBuilder::fromArray($row), $result);
    }
}