<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class ArticleModels {
    public static function readArticle(Request $request, Response $response, $args)
    {
        $database = DatabaseHandler::connexion();

        if ($database->connect_error) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur de connexion à la base de données"]));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $req = " SELECT * From article WHERE stock < 1";

        $result = $database->query($req);

        if ($result->num_rows == 1) {
            $response->getBody()->write(json_encode(["message" => "Adresse numero, $id_adresse a bien été modifier"]));
        } else {
            $response = $response->withStatus(401);
            $response->getBody()->write(json_encode(["message" => "Échec de la modification."]));
        }
        $database->close();

        return $response->withHeader('Content-Type', 'application/json');
    }

}
