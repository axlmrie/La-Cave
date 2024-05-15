<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class LogModels {
    public static function login(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $username = $data['username'];
        $password = $data['password'];

        $database = DatabaseHandler::connexion();


        if ($database->connect_error) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur de connexion à la base de données"]));
            return $response->withHeader('Content-Type', 'application/json');
        }


        $req = "SELECT * FROM utilisateurs WHERE username = '$username' AND password = '$password'";
        $result = $database->query($req);


        if ($result->num_rows == 1) {
            $response->getBody()->write(json_encode(["message" => "Authentification réussie ! Bienvenue, $username"]));
        } else {
            $response = $response->withStatus(401);
            $response->getBody()->write(json_encode(["message" => "Échec de l'authentification. Veuillez vérifier vos informations d'identification."]));
        }
        $database->close();

        return $response->withHeader('Content-Type', 'application/json');

    }


    public static function logout(Request $request, Response $response, $args)
    {

    }

}