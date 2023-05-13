<?php

namespace Clouds\Entities\Mythology;

use Oracle\Oracle;

class GetAllMythologiesWithGods
{

    /** @return Mythology[] */
    public function execute(string $order_by = null): array
    {
        $result = Oracle::getInstance()->select("
            SELECT
                m.id,
                m.name,
                g.name AS god_name,
                (SELECT COUNT(*) FROM gods g2 WHERE g2.mythology_id = m.id) AS gods_count
            FROM mythologies m
                LEFT JOIN gods g ON g.mythology_id = m.id
            WHERE 1 = 1
            GROUP BY m.id, g.id
            $order_by"
        );
        return MythologyWithGodsBuilder::fromArray($result);
    }
}
