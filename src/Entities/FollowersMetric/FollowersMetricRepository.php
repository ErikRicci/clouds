<?php

namespace Clouds\Entities\FollowersMetric;

use Clouds\Entities\FollowersMetric\Repository\GetGeneralFollowersMetrics;
use Clouds\Entities\FollowersMetric\Struct\GeneralFollowersMetrics;

class FollowersMetricRepository
{
    public static function getGeneralFollowersMetrics(?\DateTime $date): GeneralFollowersMetrics
    {
        return (new GetGeneralFollowersMetrics())->execute($date);
    }
}