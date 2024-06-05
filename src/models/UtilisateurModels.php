<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\UtilisateurEntities;
use src\handlers\DatabaseHandler;

class UtilisateurModels
{
    public static function readUtilisateurs(Request $request, Response $response, $args)
    {

        $database = DatabaseHandler::connexion();
        UtilisateurEntities::readUtilisateur($database);
        return $response;
    }

    public static function createUtilisateur(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $database = DatabaseHandler::connexion();
        $utilisateur = new UtilisateurEntities($data);
        $utilisateur->createUtilisateur($database);
        return $response;
    }

    public static function updateUtilisateur(Request $request, Response $response, $args)
    {
        $id_utilisateur = $args['id'];
        $data = $request->getParsedBody();
        $database = DatabaseHandler::connexion();
        $utilisateur = new UtilisateurEntities($data);
        $utilisateur->setIdUtilisateur($id_utilisateur);
        $utilisateur->updateUtilisateur($database);

        return $response;
    }


}
