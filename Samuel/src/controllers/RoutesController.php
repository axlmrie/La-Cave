<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class RoutesController {


    public static function world(Request $request, Response $response, $args)
    {
        $response->getBody()->write("Hello world!");
        return $response;
    }

}