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

    public static function createFournisseur(Request $request, Response $response, $args)
    {
        FournisseurModels::createFournisseur($request, $response, $args);
        return $response;

    }

    public static function updateFournisseur(Request $request, Response $response, $args)
    {
        FournisseurModels::updateFournisseur($request, $response, $args);
        return $response;

    }
}
