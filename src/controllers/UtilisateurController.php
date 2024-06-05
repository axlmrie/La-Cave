<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\UtilisateurModels;

class UtilisateurController {
    public static function readUtilisateurs(Request $request, Response $response, $args)
    {
        $results = UtilisateurModels::readUtilisateurs();
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    public static function createUtilisateur(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $results = UtilisateurModels::createUtilisateur($data);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    public static function updateUtilisateur(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $results = UtilisateurModels::updateUtilisateur($data,$id);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

}