<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\RegisterModels;


class RegisterController {
    public static function register(Request $request, Response $response, $args): response
    {
        $results = RegisterModels::register($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

}