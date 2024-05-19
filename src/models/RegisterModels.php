<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;
use src\entities\ClientEntities;



class RegisterModels {
    public static function register(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();

        try {
            $database = DatabaseHandler::connexion();
            $client = new ClientEntities($data);


            if ($client->register($database)) {
                $response->getBody()->write(json_encode(["message" => "Utilisateur enregistré avec succès"]));
            } else {
                $response = $response->withStatus(500);
                $response->getBody()->write(json_encode(["message" => "Aucun enregistrement effectué"]));
            }
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de l'inscription de l'utilisateur: " . $e->getMessage()]));
        }
        $database = null;

        return $response;


    }
}