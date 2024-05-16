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
}