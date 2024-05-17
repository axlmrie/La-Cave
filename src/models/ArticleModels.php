<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

class ArticleModels {

    public static function readArticle(Request $request, Response $response, $args)
    {
        try {
            $database = DatabaseHandler::connexion();
            $req = $database->prepare("SELECT * FROM articles WHERE stock > 1");
            $req->execute();

            if ($req->rowCount() > 0) {
                $articles = $req->fetchAll(\PDO::FETCH_ASSOC);
                //$response->getBody()->write(json_encode(["articles" => $articles]));
            } else {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(["message" => "Aucun article trouvé avec un stock inférieur à 1"]));
            }
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des articles: " . $e->getMessage()]));
        }
        $database = null;
        $response->getBody()->write(json_encode($articles));
        return $response;
    }
    public static function stockArticleNeg(Request $request, Response $response, $args)
    {
        try {
            $database = DatabaseHandler::connexion();
            $req = $database->prepare("SELECT * FROM articles WHERE stock < 1");
            $req->execute();

            if ($req->rowCount() > 0) {
                $articles = $req->fetchAll(\PDO::FETCH_ASSOC);
                //$response->getBody()->write(json_encode(["articles" => $articles]));
            } else {
                $response = $response->withStatus(404);
                $response->getBody()->write(json_encode(["message" => "Aucun article trouvé avec un stock inférieur à 1"]));
            }
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write(json_encode(["message" => "Erreur lors de la récupération des articles: " . $e->getMessage()]));
        }
        $database = null;
        $response->getBody()->write(json_encode($articles));
        return $response;
    }

    public static function articleFamille(Request $request, Response $response, $args)
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