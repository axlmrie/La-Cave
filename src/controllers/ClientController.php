<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\models\ClientModels;

class ClientController {
    public static function readClient(Request $request, Response $response, $args)
    {
        ClientModels::readClient($request, $response, $args);
    }

}
