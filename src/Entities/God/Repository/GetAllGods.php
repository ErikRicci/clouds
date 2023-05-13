<?php

namespace Clouds\Entities\God\Repository;

use Clouds\Entities\God\God;
use Clouds\Entities\God\GodBuilder;
use Oracle\Oracle;

class GetAllGods
{
    /** @return God[] */
    public function execute(string $order_by = null): array
    {
        $result = Oracle::getInstance()->select("SELECT * FROM gods WHERE 1 = 1 $order_by");
        return array_map(fn ($row) => GodBuilder::fromArray($row), $result);
    }
}
