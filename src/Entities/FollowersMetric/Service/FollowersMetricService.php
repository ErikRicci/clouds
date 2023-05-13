<?php

namespace Clouds\Entities\FollowersMetric\Service;

use Clouds\Entities\FollowersMetric\FollowersMetricRepository;
use Clouds\Entities\FollowersMetric\Struct\GeneralFollowersMetrics;

class FollowersMetricService
{
    public static function getNewAndLeavingFollowers(\DateTime $date = null): GeneralFollowersMetrics
    {
        return FollowersMetricRepository::getGeneralFollowersMetrics($date);
    }

    public static function calculatePercentageChange(int $old_new_followers, int $new_new_followers): float
    {
        if ($old_new_followers != 0) {
            $percentage_change = (($new_new_followers - $old_new_followers) / $old_new_followers) * 100;
        } else {
            // Handle the case when yesterday count is zero
            if ($new_new_followers != 0) {
                $percentage_change = 100;
            } else {
                $percentage_change = 0;
            }
        }

        return round($percentage_change, 2);
    }
}