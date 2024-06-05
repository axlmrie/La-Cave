<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\ArticleEntities;
use src\handlers\DatabaseHandler;

class StockModels {


    public static function updateStock($data,$id)
    {

        $database = DatabaseHandler::connexion();
        $stockArticle = new ArticleEntities($data);
        $stockArticle->setIdArticle($id);
        $success = $stockArticle->updateStock($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? ' Stock mis à jour avec succès' : 'Erreur lors de la création de la famille'
        ];


    }


}
