<?php

namespace Clouds\Entities\Follower\Repository;

use Clouds\Commons\Stream;
use Oracle\Oracle;

class InsertBulkFollowersForGod
{
    public function execute(int $god_id, Stream $followers_stream): void
    {
        $db = Oracle::getInstance()->getDB();
        $prepared_statement = $db->prepare("INSERT INTO followers(name, god_id) VALUES (:name, :god_id)");

        try {
            $db->beginTransaction();
            $followers_stream->each(function ($follower) use ($prepared_statement, $god_id) {
                $prepared_statement->execute([
                    'name' => gak($follower, 'name'),
                    'god_id' => $god_id
                ]);
            });
            $db->commit();
        } catch (\Throwable $th) {
            $db->rollBack();
            throw $th;
        }
    }
}