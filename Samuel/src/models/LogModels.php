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
        $user = $login->login($database);

        if ($user) {
            return [
                "id_client" => $user['id_client'],
            ];
        } else {
            return [
                "error" => "Invalid login credentials"
            ];
        }
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
