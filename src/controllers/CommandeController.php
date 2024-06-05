<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\CommandeModels;

class CommandeController {
    public static function readCommandes(Request $request, Response $response, $args)
    {
        $results = CommandeModels::readCommandes($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }
    public static function createCommandes(Request $request, Response $response, $args)
    {
        $results = CommandeModels::createCommande($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }
    public static function affichageCommandes(Request $request, Response $response, $args)
    {
        $results = CommandeModels::affichageCommandes($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    public static function deleteCommandes(Request $request, Response $response, $args)
    {
        $results = CommandeModels::deleteCommande($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }



}

