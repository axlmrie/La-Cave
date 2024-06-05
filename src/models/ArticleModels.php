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
        return ArticleEntities::readArticle($database);
    }
    public static function stockArticleNeg(Request $request, Response $response, $args)
    {
        $database = DatabaseHandler::connexion();
        return ArticleEntities::stockArticleNeg($database);
    }

    public static function articleFamille(Request $request, Response $response, $args)
    {
        $database = DatabaseHandler::connexion();
        return ArticleEntities::articleFamille($database);
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