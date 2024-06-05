<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\FamilleEntities;
use src\handlers\DatabaseHandler;

class FamilleModels {
    public static function readFamille()
    {
        $database = DatabaseHandler::connexion();
        return FamilleEntities::readFamille($database);
    }

    public static function createFamille($data)
    {
        $database = DatabaseHandler::connexion();
        $famille = new FamilleEntities($data);
        $success = $famille->createFamille($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Famille créée avec succès' : 'Erreur lors de la création de la famille'
        ];
    }

    public static function updateFamille($data, $id)
    {
        $database = DatabaseHandler::connexion();
        $famille = new FamilleEntities($data);
        $famille->setIdFamille($id);
        $success = $famille->updateFamille($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Famille mise à jour avec succès' : 'Erreur lors de la mise à jour de la famille'
        ];
    }

}
