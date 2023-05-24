<?php

namespace Clouds\Entities\God;

use Clouds\Commons\EntityStream;
use Clouds\Commons\Repository;
use Clouds\Entities\God\Enums\Alignment;
use Clouds\Entities\God\Repository\GetAllGods;
use Clouds\Entities\God\Repository\GetGodsCount;
use Clouds\Entities\God\Repository\GetGodsWithAbilities;
use Clouds\Entities\God\Stream\GodStream;

class GodRepository extends Repository
{
    /** @return God[] */
    public static function getAllGods(string $order_by = null): array
    {
        return (new GetAllGods())->execute($order_by);
    }

    public static function getGodsCount(): int
    {
        return (new GetGodsCount())->execute();
    }

    public static function insertBulkGods(array $gods): void
    {
        $gods_stream = GodStream::with($gods);
        parent::forTable('gods')->insertBulk($gods_stream);
    }

    public static function insertGod(God $god): God|false
    {
        return parent::forTable('gods')->insert($god);
    }

    public static function getGodsWithAbilities(): array
    {
        return (new GetGodsWithAbilities())->execute();
    }
}
