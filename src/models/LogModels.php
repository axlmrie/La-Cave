<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class LogModels {
    public static function login(Request $request, Response $response, $args)
    {


        $data = $request->getParsedBody();
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        try{
        $database = DatabaseHandler::connexion();
        $req = "SELECT * FROM utilisateurs WHERE username = '$username' AND password = '$password'";
        $result = $database->query($req);


        if ($result->rowCount() == 1) {
            $response->getBody()->write(json_encode(["message" => "Authentification réussie ! Bienvenue, $username"]));
        } else {
            $response = $response->withStatus(401);
            $response->getBody()->write(json_encode(["message" => "Échec de l'authentification. Veuillez vérifier vos informations d'identification."]));
        }
        }catch (\Exception $e) {
                $response = $response->withStatus(500);
                $response->getBody()->write(json_encode(["message" => "Erreur lors de l'inscription de l'utilisateur: " . $e->getMessage()]));
            }
        $database = null;
        $response->getBody()->write(json_encode($req));
        return $response;
    }


    public static function logout(Request $request, Response $response, $args)
    {

    }

}

