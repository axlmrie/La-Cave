<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\ArticleModels;

class ArticleController {
    public static function readArticle(Request $request, Response $response, $args)
    {
        $results = ArticleModels::readArticle($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);

    }
    public static function stockArticleNeg(Request $request, Response $response, $args)
    {
        $results = ArticleModels::stockArticleNeg($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }
    public static function articleFamille(Request $request, Response $response, $args)
    {
        $results = ArticleModels::articleFamille($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    public static function createArticle(Request $request, Response $response, $args)
    {
        $results = ArticleModels::createArticle($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    public static function updateArticle(Request $request, Response $response, $args)
    {
        $results = ArticleModels::updateArticle($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

}

