<?php

namespace Clouds\Entities\FollowersMetric\Struct;

use Clouds\Commons\Struct;

class GeneralFollowersMetrics extends Struct
{
    public readonly int $new_followers;
    public readonly int $leaving_followers;
    public readonly \DateTime $date;

    public function __construct(
        int $new_followers,
        int $leaving_followers,
        \DateTime|string $date,
    ) {
        $this->new_followers = $new_followers;
        $this->leaving_followers = $leaving_followers;
        $this->date = $date instanceof \DateTime
            ? $date->setTime(0, 0, 0)
            : \DateTime::createFromFormat("Y-m-d", $date)->setTime(0, 0, 0);
    }
}