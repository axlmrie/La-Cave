<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\models\UtilisateurModels;

class UtilisateurController {
    public static function readUtilisateurs(Request $request, Response $response, $args)
    {
        UtilisateurModels::readUtilisateurs($request, $response, $args);
        return $response;
    }

    public static function createUtilisateur(Request $request, Response $response, $args)
    {
        UtilisateurModels::createUtilisateur($request, $response, $args);
        return $response;
    }


}