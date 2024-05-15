<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;



class RegisterModels {
    public static function register(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();

        // Vérifiez chaque clé avant d'y accéder
        $prenom = $data['prenom'] ?? null;
        $nom = $data['nom'] ?? null;
        $password = $data['password'] ?? null;
        $date_suppression = $data['date_suppression'] ?? null;
        $adresse_livraison = $data['adresse_livraison'] ?? null;
        $adresse_facturation = $data['adresse_facturation'] ?? null;
        $numero_tel = $data['numero_tel'] ?? null;

        try {
            $database = DatabaseHandler::connexion();
            // Préparez et exécutez la requête SQL pour insérer les données dans la table utilisateurs
            $req = $database->prepare("INSERT INTO clients (prenom, nom, password, date_suppression, adresse_livraison, adresse_facturation, numero_tel) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $req->execute([$prenom, $nom, $password, $date_suppression, $adresse_livraison, $adresse_facturation, $numero_tel]);

            if ($req->rowCount() > 0) {
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
        $response->getBody()->write(json_encode($req));
        return $response;


    }
}