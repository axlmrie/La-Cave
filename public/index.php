<?php


use src\config\Routes;
use src\config\Settings;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();


Routes::loadRoutes($app);

Settings::loadSettings();

$app->run();
