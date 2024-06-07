<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\AdresseModels;

class AdresseController {

    /**
     * @OA\Put(
     *     path="/adresses/updateAdresse/{id}",
     *     tags={"Adresses"},
     *     summary="Mettre à jour une adresse existante",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID de l'adresse à mettre à jour"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="nom_rue", type="string"),
     *             @OA\Property(property="ville", type="string"),
     *             @OA\Property(property="numero_rue", type="integer"),
     *             @OA\Property(property="code_postal", type="string"),
     *             @OA\Property(property="pays", type="string"),
     *             @OA\Property(property="facturation", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Adresse mise à jour",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function updateAdresse(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $results = AdresseModels::updateAdresse($data, $id);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    /**
     * @OA\Post(
     *     path="/adresses/createAdresse",
     *     tags={"Adresses"},
     *     summary="Créer une nouvelle adresse",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="nom_rue", type="string"),
     *             @OA\Property(property="ville", type="string"),
     *             @OA\Property(property="numero_rue", type="integer"),
     *             @OA\Property(property="code_postal", type="string"),
     *             @OA\Property(property="pays", type="string"),
     *             @OA\Property(property="facturation", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Adresse créée",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function createAdresse(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $results = AdresseModels::createAdresse($data);
        return ResponseHandler::Response($request, $response, (array)$results);
    }
}