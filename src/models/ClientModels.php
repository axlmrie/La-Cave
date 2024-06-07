<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\ClientEntities;
use src\handlers\DatabaseHandler;

class ClientModels {

    /**
     * @OA\Get(
     *     path="/clients/readClient",
     *     tags={"Clients"},
     *     summary="Lire les clients",
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
    public static function readClient()
    {
        $database = DatabaseHandler::connexion();
        return ClientEntities::readClient($database);
    }
}