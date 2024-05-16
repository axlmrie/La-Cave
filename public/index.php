<?php


use src\config\Routes;
use src\config\Settings;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();


Routes::loadRoutes($app);
Routes::logRoutes($app);
Routes::articlesRoutes($app);
Routes::clientsRoutes($app);
Routes::commandesRoutes($app);
Routes::adressesRoutes($app);
Routes::utilisateursRoutes($app);
Settings::loadSettings();

$app->run();
