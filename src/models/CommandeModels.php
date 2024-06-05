<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\CommandeEntities;
use src\handlers\DatabaseHandler;

class CommandeModels {

    public static function readCommandes()
    {
        $database = DatabaseHandler::connexion();
        return CommandeEntities::readCommandes($database);
    }

    public static function createCommande($data)
    {
        $database = DatabaseHandler::connexion();
        $commande = new CommandeEntities($data);
        $success = $commande->createCommande($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Commande créée avec succès' : 'Erreur lors de la mise à jour de la famille'
        ];
    }
    public static function deleteCommande($data, $id)
    {
        $database = DatabaseHandler::connexion();
        $commande = new CommandeEntities($data);
        $commande->setIdCommande($id);
        $commande->setDateSuppression(date('Y-m-d H:i:s'));
        $success = $commande->deleteCommande($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Comande mise à jour avec succès' : 'Erreur lors de la mise à jour de la famille'
        ];

    }
    public static function affichageCommandes()
    {
        $database = DatabaseHandler::connexion();
        return CommandeEntities::affichageCommandes($database);
    }
}
