<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\DatabaseHandler;

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
        $mail = $data['mail'] ?? null;
        $password = $data['password'] ?? null;

        if (!$mail || !$password) {
            return [
                'status' => 'error',
                'message' => 'Mail et mot de passe sont requis.'
            ];
        }

        $database = DatabaseHandler::connexion();
        $req = $database->prepare("SELECT * FROM clients WHERE mail = :mail AND password = :password");
        $req->bindParam(':mail', $mail);
        $req->bindParam(':password', $password);
        $req->execute();

        if ($req->rowCount() == 1) {
            return [
                'status' => 'success',
                'message' => "Authentification réussie ! Bienvenue, $mail"
            ];
        } else {
            return [
                'status' => 'error',
                'message' => "Échec de l'authentification. Veuillez vérifier vos informations d'identification."
            ];
        }
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
