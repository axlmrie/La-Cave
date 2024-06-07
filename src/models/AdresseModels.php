<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;
use src\entities\AdresseEntities;

class AdresseModels {

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
     *             ref="#/components/schemas/Adresse"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Adresse mise à jour",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function updateAdresse($data, $id)
    {
        $database = DatabaseHandler::connexion();
        $adresse = new AdresseEntities($data);
        $adresse->setIdAdresse($id);
        $success = $adresse->updateAdresse($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Adresse mise à jour avec succès' : 'Erreur lors de la mise à jour de l\'adresse'
        ];
    }

    /**
     * @OA\Post(
     *     path="/adresses/createAdresse",
     *     tags={"Adresses"},
     *     summary="Créer une nouvelle adresse",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Adresse"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Adresse créée",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function createAdresse($data)
    {
        $database = DatabaseHandler::connexion();
        $adresse = new AdresseEntities($data);
        $success = $adresse->createAdresse($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Adresse créée avec succès' : 'Erreur lors de la création de l\'adresse'
        ];
    }
}

