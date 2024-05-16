<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class CommandeModels {

    public static function readCommandes(Request $request, Response $response, $args)
    {
        try {
            $database = DatabaseHandler::connexion();
            $req = $database->prepare("SELECT * FROM commandes");
            $req->execute();

            if ($req->rowCount() > 0) {
                $commandes = $req->fetchAll(\PDO::FETCH_ASSOC);
                //$response->getBody()->write(json_encode(["commandes" => $commandes]));
            } else {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(["message" => "Aucune commandes trouvées avec un stock inférieur à 1"]));
            }
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des commandes: " . $e->getMessage()]));
        }
        $database = null;
        $response->getBody()->write(json_encode($commandes));
        return $response;
    }
    public static function createCommandes(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $article = $data['article'] ?? null;
        $quantite = $data['quantite'] ?? null;
        $client = $data['client'] ?? null;
        $fournisseur = $data['fournisseur'] ?? null;
        $date_commande = $data['date_commande'] ?? null;
        try {


            $database = DatabaseHandler::connexion();

            $req = $database->prepare("INSERT INTO commandes VALUES ('$article', '$quantite', '$client', '$fournisseur', '$date_commande')");
            $req->execute();



            if ($req) {
                $response->getBody()->write(json_encode(["message" => "Données insérées avec succès."]));
            } else {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(["message" => "Échec de l'insertion des données."]));
            }
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des données de commandes: " . $e->getMessage()]));
        }
        $database = null;
        $response->getBody()->write(json_encode($req));
        return $response;
    }
    public static function deleteCommande(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id_commande = $data['id_commande'] ?? null;
        date_default_timezone_set('Europe/Paris');
        $date_suppression = new DateTime();
        $date_suppression = $date_suppression->format('Y-m-d');

        try {


            $database = DatabaseHandler::connexion();

            $req = $database->prepare("UPDATE commandes set date_suppression = '$date_suppression' where id_commande = '$id_commande' ");
            $req->execute();



            if ($req) {
                $response->getBody()->write(json_encode(["message" => "Données insérées avec succès."]));
            } else {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(["message" => "Échec de l'insertion des données."]));
            }
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des données de commandes: " . $e->getMessage()]));
        }
        $database = null;
        $response->getBody()->write(json_encode($req));
        return $response;
    }
    public static function affichageCommande(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();

        try {
            $database = DatabaseHandler::connexion();
            $req = $database->prepare("SELECT commandes.quantite, commandes.date_commande, clients.nom AS nom_client, fournisseurs.nom AS nom_fournisseur, articles.designation FROM commandes INNER JOIN clients ON commandes.client = clients.id_client INNER JOIN articles ON commandes.article = articles.id_article INNER JOIN fournisseurs ON commandes.fournisseur = fournisseurs.id_fournisseurs;");
            $req->execute();

            if ($req->rowCount() > 0) {
                $commandes = $req->fetchAll(\PDO::FETCH_ASSOC);
                //$response->getBody()->write(json_encode(["commandes" => $commandes]));
            } else {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(["message" => "Aucune commandes trouvées "]));
            }
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des commandes: " . $e->getMessage()]));
        }
        $database = null;
        $response->getBody()->write(json_encode($commandes));
        return $response;
    }
}
