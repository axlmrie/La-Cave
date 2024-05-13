<?php

namespace src\config;

use src\controllers\RegisterController;
use Slim\Routing\RouteCollectorProxy;
use src\controllers\LogController;
use src\Controllers\RoutesController;



class Routes{


    public static function loadRoutes($app): void
    {
        $app->group('', function (RouteCollectorProxy $group) {
            $group->get('/', RoutesController::class . ':world');
            $group->post('/register', RegisterController::class . ':register');
            //$group->post;
            //$group->delete;
            //$group->put;
        });
    }

    public static function logRoutes($app): void
    {
        $app->group('log', function (RouteCollectorProxy $group) {
            $group->post('/login', LogController::class . ':login');
            $group->post('/logout', LogController::class . ':logout');
        });
    }

}








