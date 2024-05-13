<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RegisterModels {
    public static function register(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        //adapter en fonction de la bdd
        $username = $data['username'];
        $password = $data['password'];

        $database = DatabaseHandler::connexion();

        if ($database->connect_error) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur de connexion à la base de données"]));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $req = "INSERT INTO utilisateurs (username, password) VALUES ('$username', '$password')";
        if ($database->query($req) === TRUE) {
            $response->getBody()->write(json_encode(["message" => "Utilisateur enregistré avec succès"]));
        } else {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de l'inscription de l'utilisateur"]));
        }

        $database->close();

        return $response->withHeader('Content-Type', 'application/json');
    }

}
