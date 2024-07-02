<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\UtilisateurEntities;
use src\handlers\DatabaseHandler;

class UtilisateurModels {

    public static function readUtilisateurs()
    {
        $database = DatabaseHandler::connexion();
        return UtilisateurEntities::readUtilisateur($database);
    }

    public static function createUtilisateur($data)
    {
        $database = DatabaseHandler::connexion();
        $utilisateur = new UtilisateurEntities($data);
        $success = $utilisateur->createUtilisateur($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Utilisateur créé avec succès' : 'Erreur lors de la création de l\'utilisateur'
        ];
    }


    public static function updateUtilisateur($data, $id)
    {
        $database = DatabaseHandler::connexion();
        $utilisateur = new UtilisateurEntities($data);
        $utilisateur->setIdUtilisateur($id);
        $success = $utilisateur->updateUtilisateur($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Utilisateur mis à jour avec succès' : 'Erreur lors de la mise à jour de l\'utilisateur'
        ];
    }
}
