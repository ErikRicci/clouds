<?php

namespace Clouds\Controllers;

use Clouds\Entities\Mythology\MythologyService;
use Oracle\Oracle;
use R2SSimpleRouter\Request;
use R2SSimpleRouter\Response;

class MythologyController
{
    public function index()
    {
        $mythologies = MythologyService::getAllMythologiesWithGods('order by m.id asc');
        return require __DIR__."/../../public/html/pages/content/gods/list-mythologies-with-gods.php";
    }

    public function store()
    {
        $mythology_name = Request::get("mythology");
        $god_name = Request::get("god_name");
        $mythology_id_query = Oracle::getInstance()
            ->select("SELECT id FROM mythologies WHERE name = \"$mythology_name\" LIMIT 1");
        if (empty($mythology_id_query)) {
            Oracle::getInstance()
                ->getDB()
                ->prepare("INSERT INTO mythologies(name) VALUES (:mythology_name)")
                ->execute([
                    "mythology_name" => $mythology_name
                ]);
            $mythology_id = Oracle::getInstance()
                ->getDB()
                ->lastInsertId();
        } else {
            $mythology_id = $mythology_id_query[0]['id'];
        }

        Oracle::getInstance()
            ->getDB()
            ->prepare("INSERT INTO gods(name, mythology_id) VALUES (:god_name, :mythology_id)")
            ->execute([
                "god_name" => $god_name,
                "mythology_id" => $mythology_id,
            ]);
        header("Location: /");
        exit();
    }

    public function getTopMythologies()
    {
        $quantity_to_fetch = Request::get("quantity_to_fetch", 3);
        $top_mythologies = MythologyService::getTopMythologiesByFollowers($quantity_to_fetch);

        Response::success([
            'top_mythologies' => $top_mythologies
        ]);
    }
}
