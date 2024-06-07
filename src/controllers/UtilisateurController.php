<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\UtilisateurModels;

class UtilisateurController {

    /**
     * @OA\Get(
     *     path="/utilisateurs/readUtilisateurs",
     *     tags={"Utilisateurs"},
     *     summary="Obtenir tous les utilisateurs",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des utilisateurs",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Utilisateur")
     *         )
     *     )
     * )
     */
    public static function readUtilisateurs(Request $request, Response $response, $args)
    {
        $results = UtilisateurModels::readUtilisateurs();
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    /**
     * @OA\Post(
     *     path="/utilisateurs/createUtilisateur",
     *     tags={"Utilisateurs"},
     *     summary="Créer un nouvel utilisateur",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="matricule", type="string"),
     *             @OA\Property(property="date_suppression", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur créé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function createUtilisateur(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $results = UtilisateurModels::createUtilisateur($data);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    /**
     * @OA\Put(
     *     path="/utilisateurs/updateUtilisateur/{id}",
     *     tags={"Utilisateurs"},
     *     summary="Mettre à jour un utilisateur existant",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID de l'utilisateur à mettre à jour"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="matricule", type="string"),
     *             @OA\Property(property="date_suppression", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur mis à jour",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function updateUtilisateur(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $results = UtilisateurModels::updateUtilisateur($data, $id);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

}