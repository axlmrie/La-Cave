<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\FamilleModels;

class FamilleController {


    public static function readFamille(Request $request, Response $response, $args): Response
    {
        $results = FamilleModels::readFamille();
        return ResponseHandler::Response($request, $response, (array)$results);
    }


    public static function createFamille(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $results = FamilleModels::createFamille($data);
        return ResponseHandler::Response($request, $response, (array)$results);
    }


    public static function updateFamille(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $results = FamilleModels::updateFamille($data, $id);
        return ResponseHandler::Response($request, $response, (array)$results);
    }
}
