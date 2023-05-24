<?php

use R2SSimpleRouter\Enums\RouteMethod;
use R2SSimpleRouter\Managers\RouteManager;
use R2SSimpleRouter\Route;

require __DIR__ . '/../vendor/autoload.php';

CORS::enableCORS();

function exception_handler(Throwable $exception)
{
    if ($exception instanceof \PDOException) {
        if (str_contains($exception->getMessage(), "SQLSTATE[42S02]: Base table or view not found")) {
            throw new \PDOException($exception->getMessage() . ". Check if your Model is correctly named and/or its \$table_name is correctly set up.");
        }
    }

    return require __DIR__ . "/html/pages/exceptions/exception.php";
}

set_exception_handler('exception_handler');

\Oracle\Oracle::getInstance(
    new \Oracle\Configs\OracleConnectionConfigs(
        "clouds",
        "root",
        "password",
        "db"
    )
);

new RouteManager([
    new Route("/authenticate", RouteMethod::POST, [\Clouds\Controllers\AuthenticationController::class, "login"]),
    new Route("/dashboard", RouteMethod::GET, [\Clouds\Controllers\DashboardController::class, "index"]),
    new Route("/dashboard-2", RouteMethod::GET, [\Clouds\Controllers\DashboardController::class, "getGodsWithAbilities"]),
    new Route("/create-mythology", RouteMethod::POST, [\Clouds\Controllers\MythologyController::class, "store"]),
    new Route("/top-mythologies", RouteMethod::GET, [\Clouds\Controllers\MythologyController::class, "getTopMythologies"]),
    new Route("/realms/:realm_id", RouteMethod::GET, [\Clouds\Controllers\RealmController::class, "show"]),
    new Route("/create-god", RouteMethod::POST, [\Clouds\Controllers\GodController::class, "store"]),
    new Route("/create-realm", RouteMethod::POST, [\Clouds\Controllers\RealmController::class, "store"]),

    /** COMMANDS */
    new Route("/command/generateGods", RouteMethod::GET, [\Clouds\Controllers\GodController::class, "generateGods"]),
    new Route("/command/generateFollowers", RouteMethod::GET, [\Clouds\Controllers\FollowerController::class, "generateFollowers"]),
]);

class CORS
{
    public static function enableCORS(): void
    {
        // Specify domains from which requests are allowed
        header('Access-Control-Allow-Origin: *');
        // Specify which request methods are allowed
        header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
        // Additional headers which may be sent along with the CORS request
        header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');
        // Set the age to 1 day to improve speed/caching.
        header('Access-Control-Max-Age: 86400');
    }
}
