<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;
use src\entities\ClientEntities;

class RegisterModels {

    /**
     * @OA\Post(
     *     path="/clients/register",
     *     tags={"Clients"},
     *     summary="Créer un nouveau compte client",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="password", type="string"),
     *             @OA\Property(property="adresse_livraison", type="integer"),
     *             @OA\Property(property="adresse_facturation", type="integer"),
     *             @OA\Property(property="numero_tel", type="string"),
     *             @OA\Property(property="mail", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Compte client créé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur lors de la création du compte client",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function register($data)
    {
        $database = DatabaseHandler::connexion();
        $client = new ClientEntities($data);
        $success = $client->register($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Compte client créé avec succès' : 'Erreur lors de la création de l\'utilisateur'
        ];
    }
}