<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\FournisseurModels;

class FournisseurController {

    public static function readFournisseurs(Request $request, Response $response, $args)
    {
        $results = FournisseurModels::readFournisseurs($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    public static function createFournisseur(Request $request, Response $response, $args)
    {
        $results = FournisseurModels::createFournisseur($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    public static function updateFournisseur(Request $request, Response $response, $args)
    {
        $results = FournisseurModels::updateFournisseur($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);

    }
}
