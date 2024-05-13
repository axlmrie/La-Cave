<?php

namespace src\config;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;
use src\Controllers\RoutesController;



class Routes{


    public static function loadRoutes($app)
    {
        $app->group('', function (RouteCollectorProxy $group) {
            $group->get('/', RoutesController::class . ':world');
            //$group->;
            //$group->;

        });


    }

}








