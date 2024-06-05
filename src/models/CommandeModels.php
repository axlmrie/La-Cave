<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\CommandeEntities;
use src\handlers\DatabaseHandler;

class CommandeModels {

    public static function readCommandes(Request $request, Response $response, $args)
    {
        $database = DatabaseHandler::connexion();
        CommandeEntities::readCommandes($database);
        return $response;
    }

    public static function createCommande(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $database = DatabaseHandler::connexion();
        $commande = new CommandeEntities($data);
        $commande->createCommande($database);
        return $response;
    }
    public static function deleteCommande(Request $request, Response $response, $args)
    {
        $id_commande = $args['id'];
        $data = $request->getParsedBody();

        $database = DatabaseHandler::connexion();
        $commande = new CommandeEntities($data);
        $commande->setIdCommande($id_commande);
        $commande->setDateSuppression(date('Y-m-d H:i:s'));
        $commande->deleteCommande($database);

        return $response;

    }
    public static function affichageCommandes(Request $request, Response $response, $args)
    {
        $database = DatabaseHandler::connexion();
        CommandeEntities::affichageCommandes($database);
        return $response;
    }
}
