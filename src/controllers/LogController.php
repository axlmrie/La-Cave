<?php


namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\logModels;

class LogController
{

    public static function login(Request $request, Response $response, $args)
    {
         $results = logModels::login($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    public static function logout(Request $request, Response $response, $args)
    {
        $results = logModels::logout($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }


}