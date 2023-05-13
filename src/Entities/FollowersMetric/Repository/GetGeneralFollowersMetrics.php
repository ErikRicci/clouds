<?php

namespace Clouds\Entities\FollowersMetric\Repository;

use Clouds\Entities\FollowersMetric\Struct\GeneralFollowersMetrics;
use Oracle\Oracle;

class GetGeneralFollowersMetrics
{
    public function execute(?\DateTime $date): GeneralFollowersMetrics
    {
        $date_to_query = ($date ?: new \DateTime())->format("Y-m-d");
        $query = <<<SQL
        SELECT
            IFNULL(SUM(new_followers), 0) AS new_followers,
            IFNULL(SUM(leaving_followers), 0) AS leaving_followers
        FROM
            followers_metrics
        WHERE date = "$date_to_query"
        SQL;

        $result = Oracle::getInstance()->select($query)[0];
        return new GeneralFollowersMetrics(
            gak($result, 'new_followers'),
            gak($result, 'leaving_followers'),
            $date_to_query
        );
    }
}