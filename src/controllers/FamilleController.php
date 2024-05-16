<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\models\FamilleModels;

class FamilleController {
    public static function readFamille(Request $request, Response $response, $args)
    {
        FamilleModels::readFamille($request, $response, $args);
        return $response;
    }

    public static function createFamille(Request $request, Response $response, $args)
    {
        FamilleModels::createFamille($request, $response, $args);
        return $response;
    }

    public static function updateFamille(Request $request, Response $response, $args)
    {
        FamilleModels::updateFamille($request, $response, $args);
        return $response;
    }
}
