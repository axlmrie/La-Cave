<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\FournisseurEntities;
use src\handlers\DatabaseHandler;

class FournisseurModels {

    /**
     * @OA\Get(
     *     path="/fournisseurs/readFournisseurs",
     *     tags={"Fournisseurs"},
     *     summary="Lire les fournisseurs",
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
    public static function readFournisseurs()
    {
        $database = DatabaseHandler::connexion();
        return FournisseurEntities::readFournisseurs($database);
    }

    /**
     * @OA\Post(
     *     path="/fournisseurs/createFournisseur",
     *     tags={"Fournisseurs"},
     *     summary="Créer un nouveau fournisseur",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Fournisseur"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Fournisseur créé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function createFournisseur($data)
    {
        $database = DatabaseHandler::connexion();
        $fournisseur = new FournisseurEntities($data);
        $success = $fournisseur->createFournisseur($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Fournisseur créé avec succès' : 'Erreur lors de la création du fournisseur'
        ];
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
     *             ref="#/components/schemas/Fournisseur"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Fournisseur mis à jour",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function updateFournisseur($data, $id)
    {
        $database = DatabaseHandler::connexion();
        $fournisseur = new FournisseurEntities($data);
        $fournisseur->setIdFournisseur($id);
        $success = $fournisseur->updateFournisseur($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Fournisseur mis à jour avec succès' : 'Erreur lors de la mise à jour du fournisseur'
        ];
    }
}