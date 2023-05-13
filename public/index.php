<?php

use R2SSimpleRouter\Managers\RouteManager;

require __DIR__ . '/../vendor/autoload.php';

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
    // Define routes
]);
