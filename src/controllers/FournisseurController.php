<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\models\FournisseurModels;

class FournisseurController {

    public static function readFournisseurs(Request $request, Response $response, $args)
    {
        FournisseurModels::readFournisseurs($request, $response, $args);
        return $response;
    }

    public static function createFournisseurs(Request $request, Response $response, $args)
    {
        FournisseurModels::createFournisseurs($request, $response, $args);
        return $response;
    }

    public static function updateFournisseurs(Request $request, Response $response, $args)
    {
        FournisseurModels::updateFournisseurs($request, $response, $args);
        return $response;
    }

}
