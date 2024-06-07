<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\FournisseurModels;

class FournisseurController {

    /**
     * @OA\Get(
     *     path="/fournisseurs/readFournisseurs",
     *     tags={"Fournisseurs"},
     *     summary="Obtenir tous les fournisseurs",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des fournisseurs",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Fournisseur")
     *         )
     *     )
     * )
     */
    public static function readFournisseurs(Request $request, Response $response, $args)
    {
        $results = FournisseurModels::readFournisseurs($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    /**
     * @OA\Post(
     *     path="/fournisseurs/createFournisseur",
     *     tags={"Fournisseurs"},
     *     summary="Créer un nouveau fournisseur",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="numero_tel", type="string"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="adresse", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Fournisseur créé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function createFournisseur(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $results = FournisseurModels::createFournisseur($data);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    /**
     * @OA\Put(
     *     path="/fournisseurs/updateFournisseur/{id}",
     *     tags={"Fournisseurs"},
     *     summary="Mettre à jour un fournisseur existant",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID du fournisseur à mettre à jour"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="numero_tel", type="string"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="adresse", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Fournisseur mis à jour",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function updateFournisseur(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $results = FournisseurModels::updateFournisseur($data, $id);
        return ResponseHandler::Response($request, $response, (array)$results);
    }
}
