<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\FamilleEntities;
use src\handlers\DatabaseHandler;

class FamilleModels {
    public static function readFamille(Request $request, Response $response, $args)
    {
        $database = DatabaseHandler::connexion();
        FamilleEntities::readFamille($database);
        return $response;
    }

    public static function createFamille(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $database = DatabaseHandler::connexion();
        $famille = new FamilleEntities($data);
        $famille->createFamille($database);
        return $response;
    }

    public static function updateFamille(Request $request, Response $response, $args)
    {
        $id_famille = $args['id'];
        $data = $request->getParsedBody();
        $database = DatabaseHandler::connexion();
        $famille = new FamilleEntities($data);
        $famille->setIdFamille($id_famille);
        $famille->updateFamille($database);
        return $response;
    }

}
