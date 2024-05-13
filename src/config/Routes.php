<?php

namespace src\config;

use Slim\Routing\RouteCollectorProxy;
use src\Controllers\RoutesController;



class Routes{


    public static function loadRoutes($app)
    {
        $app->group('', function (RouteCollectorProxy $group) {
            $group->get('/', RoutesController::class . ':world');
            //$group->post;
            //$group->delete;
            //$group->put;
        });
    }

}








