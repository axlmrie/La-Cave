<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;
use src\entities\ClientEntities;

class RegisterModels {

    public static function register($data)
    {
        $database = DatabaseHandler::connexion();
        $client = new ClientEntities($data);
        $success = $client->register($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Compte client créé avec succès' : 'Erreur lors de la création de l\'utilisateur'
        ];
    }
}