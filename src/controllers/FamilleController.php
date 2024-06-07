<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\FamilleModels;

class FamilleController {

    /**
     * @OA\Get(
     *     path="/famille/readFamille",
     *     tags={"Famille"},
     *     summary="Obtenir toutes les familles",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des familles",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Famille")
     *         )
     *     )
     * )
     */
    public static function readFamille(Request $request, Response $response, $args): Response
    {
        $results = FamilleModels::readFamille();
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    /**
     * @OA\Post(
     *     path="/famille/createFamille",
     *     tags={"Famille"},
     *     summary="Créer une nouvelle famille",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="cepage", type="string"),
     *             @OA\Property(property="annee", type="integer"),
     *             @OA\Property(property="vignoble", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Famille créée",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function createFamille(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $results = FamilleModels::createFamille($data);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    /**
     * @OA\Put(
     *     path="/famille/updateFamille/{id}",
     *     tags={"Famille"},
     *     summary="Mettre à jour une famille existante",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID de la famille à mettre à jour"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="cepage", type="string"),
     *             @OA\Property(property="annee", type="integer"),
     *             @OA\Property(property="vignoble", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Famille mise à jour",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function updateFamille(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $results = FamilleModels::updateFamille($data, $id);
        return ResponseHandler::Response($request, $response, (array)$results);
    }
}
