<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\StockModels;

class StockController {

    /**
     * @OA\Post(
     *     path="/stock/updateStock/{id}",
     *     tags={"Stock"},
     *     summary="Mettre à jour le stock d'un article",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID de l'article dont le stock doit être mis à jour"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="stock", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Stock mis à jour",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public function updateStock(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $results = StockModels::updateStock($data, $id);
        return ResponseHandler::Response($request, $response, (array)$results);
    }
}
