<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\models\ArticleModels;

class ArticleController {
    public static function readArticle(Request $request, Response $response, $args)
    {
        ArticleModels::readArticle($request, $response, $args);
        return $response;

    }
    public static function stockArticleNeg(Request $request, Response $response, $args)
    {
        ArticleModels::stockArticleNeg($request, $response, $args);
        return $response;
    }
    public static function articleFamille(Request $request, Response $response, $args)
    {
        ArticleModels::articleFamille($request, $response, $args);
        return $response;
    }

    public static function createArticle(Request $request, Response $response, $args)
    {
        ArticleModels::createArticle($request, $response, $args);
        return $response;
    }

    public static function updateArticle(Request $request, Response $response, $args)
    {
        ArticleModels::updateArticle($request, $response, $args);
        return $response;
    }

}

