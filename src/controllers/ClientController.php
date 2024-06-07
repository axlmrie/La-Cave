<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\ClientModels;

class ClientController {

    /**
     * @OA\Get(
     *     path="/clients/readClient",
     *     tags={"Clients"},
     *     summary="Obtenir tous les clients",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des clients",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Client")
     *         )
     *     )
     * )
     */
    public static function readClient(Request $request, Response $response, $args)
    {
        $results = ClientModels::readClient($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

}
