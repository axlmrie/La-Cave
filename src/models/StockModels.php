<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\ArticleEntities;
use src\handlers\DatabaseHandler;

class StockModels {


    public static function updateStock(Request $request, Response $response, $args)
    {
        $id_article = $args['id'];
        $data = $request->getParsedBody();
        $database = DatabaseHandler::connexion();
        $stockArticle = new ArticleEntities($data);
        $stockArticle->setIdArticle($id_article);
        $stockArticle->updateStock($database);

        return $response;
    }


}
