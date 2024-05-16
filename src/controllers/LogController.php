<?php


namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\models\logModels;

class LogController
{

    public static function login(Request $request, Response $response, $args)
    {
         logModels::login($request, $response, $args);
         return $response;
    }

    public static function logout(Request $request, Response $response, $args)
    {
        logModels::logout($request, $response, $args);
        return $response;
    }


}