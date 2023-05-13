<?php

namespace Clouds\Entities\God\Repository;

use Oracle\Oracle;

class GetGodsCount
{
    public function execute(): int
    {
        $result = Oracle::getInstance()->select("SELECT COUNT(*) AS gods_count FROM gods WHERE 1 = 1");
        return $result[0]['gods_count'];
    }
}
