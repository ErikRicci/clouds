<?php

namespace Clouds\Controllers;

use Clouds\Entities\God\Service\GodFollowerService;
use R2SSimpleRouter\Request;
use R2SSimpleRouter\Response;

class FollowerController
{
    public function generateFollowers()
    {
        $god_id = Request::get('god_id');
        $followers_to_generate = Request::get('followers_to_generate');

        GodFollowerService::generateFollowersForGod($god_id, $followers_to_generate);

        Response::success(message: 'Generated!');
    }
}