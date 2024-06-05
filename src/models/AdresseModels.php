<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;
use src\entities\AdresseEntities;

class AdresseModels {


    public static function updateAdresse($data, $id)
    {

        $database = DatabaseHandler::connexion();
        $adresse = new AdresseEntities($data);
        $adresse->setIdAdresse($id);
        $success = $adresse->updateAdresse($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Adresse mise à jour avec succès' : 'Erreur lors de la création de la famille'
        ];

    }

    public static function createAdresse($data)
    {
        $database = DatabaseHandler::connexion();
        $adresse = new AdresseEntities($data);
        $success = $adresse->createAdresse($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Adresse créée avec succès' : 'Erreur lors de la création de la famille'
        ];
    }



}

