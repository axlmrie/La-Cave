<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\ClientModels;

class ClientController {
    public static function readClient(Request $request, Response $response, $args)
    {
        $results = ClientModels::readClient($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

}
