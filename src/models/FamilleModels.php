<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\FamilleEntities;
use src\handlers\DatabaseHandler;

class FamilleModels {

    /**
     * @OA\Get(
     *     path="/famille/readFamille",
     *     tags={"Familles"},
     *     summary="Lire les familles",
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
    public static function readFamille()
    {
        $database = DatabaseHandler::connexion();
        return FamilleEntities::readFamille($database);
    }

    /**
     * @OA\Post(
     *     path="/famille/createFamille",
     *     tags={"Familles"},
     *     summary="Créer une nouvelle famille",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Famille"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Famille créée",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function createFamille($data)
    {
        $database = DatabaseHandler::connexion();
        $famille = new FamilleEntities($data);
        $success = $famille->createFamille($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Famille créée avec succès' : 'Erreur lors de la création de la famille'
        ];
    }

    /**
     * @OA\Put(
     *     path="/famille/updateFamille/{id}",
     *     tags={"Familles"},
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
     *             ref="#/components/schemas/Famille"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Famille mise à jour",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function updateFamille($data, $id)
    {
        $database = DatabaseHandler::connexion();
        $famille = new FamilleEntities($data);
        $famille->setIdFamille($id);
        $success = $famille->updateFamille($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Famille mise à jour avec succès' : 'Erreur lors de la mise à jour de la famille'
        ];
    }
}