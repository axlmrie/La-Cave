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

    public static function createArticle(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $database = DatabaseHandler::connexion();
        $article = new ArticleEntities($data);
        $article->createArticle($database);
        return $response;
    }

    public static function updateArticle(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $database = DatabaseHandler::connexion();
        $article = new ArticleEntities($data);
        $article->updateArticle($database);
        return $response;
    }
}