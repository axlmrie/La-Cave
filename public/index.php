<?php

use src\config\Routes;
use src\config\Settings;
use Slim\Factory\AppFactory;
use Tuupola\Middleware\CorsMiddleware;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->addErrorMiddleware(true, true, true);
$app->add(new CorsMiddleware([
    "origin" => ["*"],
    "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
    "headers.allow" => [],
    "headers.expose" => [],
    "credentials" => false,
    "cache" => 0,
]));

Settings::loadSettings();
Routes::loadRoutes($app);
Routes::logRoutes($app);
Routes::articlesRoutes($app);
Routes::clientsRoutes($app);
Routes::commandesRoutes($app);
Routes::adressesRoutes($app);
Routes::utilisateursRoutes($app);
Routes::stockRoutes($app);
Settings::loadSettings();

try {
    $app->run();
} catch (Exception $e) {
    // Affichage d'un message d'erreur
    die(json_encode(array("status" => "failed", "message" => "This action is not allowed")));
}
