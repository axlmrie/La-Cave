<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\RegisterModels;

class RegisterController {

    /**
     * @OA\Post(
     *     path="/clients/register",
     *     tags={"Clients"},
     *     summary="Enregistrer un nouveau client",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="adresse_livraison", type="integer"),
     *             @OA\Property(property="adresse_facturation", type="integer"),
     *             @OA\Property(property="numero_tel", type="string"),
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Client enregistré",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function register(Request $request, Response $response, $args): Response
    {
        $results = RegisterModels::register($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

}