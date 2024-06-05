<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\ArticleEntities;
use src\handlers\DatabaseHandler;

class ArticleModels {

    public static function readArticle(Request $request, Response $response, $args)
    {
        $database = DatabaseHandler::connexion();
        ArticleEntities::readArticle($database);
        return $response;
    }
    public static function stockArticleNeg(Request $request, Response $response, $args)
    {
        $database = DatabaseHandler::connexion();
        ArticleEntities::stockArticleNeg($database);
        return $response;
    }

    public static function articleFamille(Request $request, Response $response, $args)
    {
        $database = DatabaseHandler::connexion();
        ArticleEntities::articleFamille($database);
        return $response;
    }

    public static function createArticle($data)
    {
        $database = DatabaseHandler::connexion();
        $article = new ArticleEntities($data);
        $success = $article->createArticle($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Article mis à jour avec succès' : 'Erreur lors de la création de la famille'
        ];
    }

    public static function updateArticle($data,$id)
    {

        $database = DatabaseHandler::connexion();
        $article = new ArticleEntities($data);
        $article->setIdArticle($id);
        $success = $article->updateArticle($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Article mis à jour avec succès' : 'Erreur lors de la création de la famille'
        ];

    }
}