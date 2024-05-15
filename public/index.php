<?php


use src\config\Routes;
use src\config\Settings;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';


$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

Settings::loadSettings();
Routes::loadRoutes($app);
Routes::logRoutes($app);
Routes::clientsRoutes($app);
Routes::articlesRoutes($app);
Routes::adressesRoutes($app);


try {
    $app->run();
} catch (Exception $e) {
    // We display a error message
    die( json_encode(array("status" => "failed", "message" => "This action is not allowed")));
}
