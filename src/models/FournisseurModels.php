<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\FournisseurEntities;
use src\handlers\DatabaseHandler;

class FournisseurModels {
    public static function readFournisseurs(Request $request, Response $response, $args)
    {
        $database = DatabaseHandler::connexion();
        FournisseurEntities::readFournisseurs($database);
        return $response;
    }

    public static function createFournisseur(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $database = DatabaseHandler::connexion();
        $fournisseur = new FournisseurEntities($data);
        $fournisseur->createFournisseur($database);
        return $response;
    }

    public static function updateFournisseur(Request $request, Response $response, $args)
    {
        $id_fournisseur = $args['id'];
        $data = $request->getParsedBody();
        $database = DatabaseHandler::connexion();
        $fournisseur = new FournisseurEntities($data);
        $fournisseur->setIdFournisseur($id_fournisseur);
        $fournisseur->updateFournisseur($database);

        return $response;
    }


}
