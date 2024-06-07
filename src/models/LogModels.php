<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;
use src\entities\ClientEntities;

class LogModels {


     public static function login($data)
    {
        $database = DatabaseHandler::connexion();
        $login = new ClientEntities($data);
        $success = $login->login($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Client connecté avec succès' : 'Erreur lors de la mise à jour de la famille'
        ];
    }

    public static function logout()
    {
        session_start();
        session_destroy();

        return [
            'status' => 'success',
            'message' => "Déconnexion réussie."
        ];
    }

}
