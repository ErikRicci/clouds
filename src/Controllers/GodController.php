<?php

namespace Clouds\Controllers;

use Clouds\Entities\God\Service\GodFollowerService;
use Clouds\Entities\God\Service\GodService;
use R2SSimpleRouter\Request;
use R2SSimpleRouter\Response;

class GodController
{
    public function index()
    {
        $gods = GodService::getAllGods('order by name asc');
        return require __DIR__."/../../pages/content/gods/list-gods.php";
    }

    public function getFollowers()
    {
        $followers = GodFollowerService::getFollowersForGod(1);
        // TODO: Discover how to make so that the WHERE/WHERELIKE clauses are added it won't change the whole class
        // Ex.:
        // $a = StreamOfKittens::get() should return [['sound' => 'meow'], ['sound' => 'miau'], ['sound' => 'mow']]
        // $b = StreamOfKittens::where(fn ($k) => strlen(gak($k, 'sound') < 4)->get() should return [['sound' => 'mow']]
        // $a = StreamOfKittens::get() should still return [['sound' => 'meow'], ['sound' => 'miau'], ['sound' => 'mow']]
        Response::success([
            'followers' => $followers->get(),
            'followers_count' => $followers->count(),
            'filtered_followers' => $followers->where(fn ($follower) => gak($follower, 'name') == 'erik')->whereLike('surname', 'RiCCiOppO')->get(),
            'filtered_followers_count' => $followers->where(fn ($follower) => gak($follower, 'name') == 'erik')->whereLike('surname', 'RiCCiOppO')->count(),
        ]);
    }

    public function store()
    {
        $god = GodService::createGod(Request::all());

        Response::success([
            'god' => $god
        ]);
    }

    public function generateGods()
    {
        $gods = GodService::generateGods(5);

        Response::success([
            'generated' => 10,
            'gods' => $gods->get(),
        ]);
    }
}
