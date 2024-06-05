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
        return UtilisateurEntities::readUtilisateur($database);
    }

    public static function createUtilisateur(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $database = DatabaseHandler::connexion();
        $utilisateur = new UtilisateurEntities($data);
        $success = $utilisateur->createUtilisateur($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Famille créée avec succès' : 'Erreur lors de la création de la famille'
        ];
    }

    public static function updateUtilisateur($data,$id)
    {
        $database = DatabaseHandler::connexion();
        $utilisateur = new UtilisateurEntities($data);
        $utilisateur->setIdUtilisateur($id);
        $success = $utilisateur->updateUtilisateur($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? ' créée avec succès' : 'Erreur lors de la création de la famille'
        ];


    }


}
