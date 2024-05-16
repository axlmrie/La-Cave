<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class RoutesController {

    public static function world(Request $request, Response $response, $args)
    {
            $response->getBody()->write("Hello world!");
            return $response;
    }

    public static function testLogin(Request $request, Response $response, $args)
    {
        try {

            $database = DatabaseHandler::connexion();
            $req = $database->query("SHOW TABLES");
            $tables = $req->fetchAll(\PDO::FETCH_ASSOC);
            var_dump($tables);
            // Si la connexion est établie, renvoyer une réponse de réussite
            $response->getBody()->write("Connexion à la base de données réussie.");
            return $response->withStatus(200);;
        } catch (\Exception $e) {

            $response->getBody()->write("Erreur de connexion à la base de données : " . $e->getMessage());

            return $response->withStatus(500);
        }
    }
}