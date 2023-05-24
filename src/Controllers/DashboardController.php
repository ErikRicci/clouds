<?php

namespace Clouds\Controllers;

use Clouds\Entities\Follower\Service\FollowerService;
use Clouds\Entities\FollowersMetric\Service\FollowersMetricService;
use Clouds\Entities\God\Service\GodService;
use Clouds\Utils\Cache\Cerebro;
use R2SSimpleRouter\Response;

class DashboardController
{
    public function index()
    {
        $gods_count = GodService::getGodsCount();
        $followers_count = FollowerService::getFollowersCount();
        $followers_metrics = FollowersMetricService::getNewAndLeavingFollowers();
        $yesterday_followers_metrics = Cerebro::get(
            'yesterday_followers_metric',
            fn () => FollowersMetricService::getNewAndLeavingFollowers(now()->modify("-1 day")),
            30
        );
        $new_followers = $followers_metrics->new_followers;
        $leaving_followers = $followers_metrics->leaving_followers;
        $yesterday_new_followers = $yesterday_followers_metrics->new_followers;
        $yesterday_leaving_followers = $yesterday_followers_metrics->leaving_followers;
        $new_followers_percentage_change_since_yesterday = FollowersMetricService::calculatePercentageChange($yesterday_new_followers, $new_followers);
        $leaving_followers_percentage_change_since_yesterday = FollowersMetricService::calculatePercentageChange($yesterday_leaving_followers, $leaving_followers);

        Response::success([
            'gods_count' => $gods_count,
            'followers_count' => $followers_count,
            'new_followers' => $new_followers,
            'yesterday_new_followers' => $yesterday_new_followers,
            'new_followers_percentage_change_since_yesterday' => $new_followers_percentage_change_since_yesterday,
            'leaving_followers' => $leaving_followers,
            'yesterday_leaving_followers' => $yesterday_leaving_followers,
            'leaving_followers_percentage_change_since_yesterday' => $leaving_followers_percentage_change_since_yesterday
        ]);
    }

    public function getGodsWithAbilities()
    {
        $gods = GodService::getGodsWithAbilities();

        Response::success([
            'gods' => $gods
        ]);
    }
}