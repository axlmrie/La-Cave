<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;
use src\entities\AdresseEntities;

class AdresseModels {


    public static function updateAdresse(Request $request, Response $response, $args)
    {
        $id_adresse = $args['id'];
        $data = $request->getParsedBody();

        $database = DatabaseHandler::connexion();
        $adresse = new AdresseEntities($data);
        $adresse->setIdAdresse($id_adresse);
        $adresse->updateAdresse($database);

        return $response;
    }

    public static function createAdresse(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $database = DatabaseHandler::connexion();
        $adresse = new AdresseEntities($data);
        $adresse->createAdresse($database);

        return $response;
    }



}

