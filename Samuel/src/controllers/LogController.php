<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;
use src\handlers\ResponseHandler;
use src\models\LogModels;

class LogController {

    public static function login(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $results = LogModels::login($data);
        return ResponseHandler::Response($request, $response, (array)$results);
    }


    public static function logout(Request $request, Response $response, $args)
    {
        $results = LogModels::logout();
        return ResponseHandler::Response($request, $response, $results);
    }
}