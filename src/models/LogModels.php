<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;
use src\entities\ClientEntities;

class LogModels {

    /**
     * @OA\Post(
     *     path="/log/login",
     *     tags={"Log"},
     *     summary="Authentifier un utilisateur",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="mail", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Authentification réussie",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Échec de l'authentification",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur serveur",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
     public static function login($data)
    {
        $database = DatabaseHandler::connexion();
        $login = new ClientEntities($data);
        $success = $login->login($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Client connecté avec succès' : 'Erreur lors de la mise à jour de la famille'
        ];
    }
       

    /**
     * @OA\Post(
     *     path="/log/logout",
     *     tags={"Log"},
     *     summary="Déconnecter un utilisateur",
     *     @OA\Response(
     *         response=200,
     *         description="Déconnexion réussie",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function logout()
    {
        session_start();
        session_destroy();

        return [
            'status' => 'success',
            'message' => "Déconnexion réussie."
        ];
    }

}
