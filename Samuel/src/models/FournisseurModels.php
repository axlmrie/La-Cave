<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\FournisseurEntities;
use src\handlers\DatabaseHandler;

class FournisseurModels {

    public static function readFournisseurs()
    {
        $database = DatabaseHandler::connexion();
        return FournisseurEntities::readFournisseurs($database);
    }

    public static function createFournisseur($data)
    {
        $database = DatabaseHandler::connexion();
        $fournisseur = new FournisseurEntities($data);
        $success = $fournisseur->createFournisseur($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Fournisseur créé avec succès' : 'Erreur lors de la création du fournisseur'
        ];
    }

    public static function updateFournisseur($data, $id)
    {
        $database = DatabaseHandler::connexion();
        $fournisseur = new FournisseurEntities($data);
        $fournisseur->setIdFournisseur($id);
        $success = $fournisseur->updateFournisseur($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Fournisseur mis à jour avec succès' : 'Erreur lors de la mise à jour du fournisseur'
        ];
    }
}