<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\ArticleEntities;
use src\handlers\DatabaseHandler;

class StockModels {

    /**
     * @OA\Put(
     *     path="/stock/updateStock/{id}",
     *     tags={"Stock"},
     *     summary="Mettre à jour le stock d'un article",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID de l'article dont le stock est mis à jour"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Article"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Stock mis à jour",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function updateStock($data, $id)
    {
        $database = DatabaseHandler::connexion();
        $stockArticle = new ArticleEntities($data);
        $stockArticle->setIdArticle($id);
        $success = $stockArticle->updateStock($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Stock mis à jour avec succès' : 'Erreur lors de la mise à jour du stock'
        ];
    }
}
