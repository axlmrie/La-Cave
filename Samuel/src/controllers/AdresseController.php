<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\AdresseModels;

class AdresseController {


    public static function updateAdresse(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $results = AdresseModels::updateAdresse($data, $id);
        return ResponseHandler::Response($request, $response, (array)$results);
    }


    public static function createAdresse(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $results = AdresseModels::createAdresse($data);
        return ResponseHandler::Response($request, $response, (array)$results);
    }
}