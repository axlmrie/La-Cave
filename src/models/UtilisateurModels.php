<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\UtilisateurEntities;
use src\handlers\DatabaseHandler;

class UtilisateurModels {

    /**
     * @OA\Get(
     *     path="/utilisateurs/readUtilisateurs",
     *     tags={"Utilisateurs"},
     *     summary="Lire les utilisateurs",
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
    public static function readUtilisateurs()
    {
        $database = DatabaseHandler::connexion();
        return UtilisateurEntities::readUtilisateur($database);
    }

    /**
     * @OA\Post(
     *     path="/utilisateurs/createUtilisateur",
     *     tags={"Utilisateurs"},
     *     summary="Créer un nouvel utilisateur",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Utilisateur"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur créé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function createUtilisateur($data)
    {
        $database = DatabaseHandler::connexion();
        $utilisateur = new UtilisateurEntities($data);
        $success = $utilisateur->createUtilisateur($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Utilisateur créé avec succès' : 'Erreur lors de la création de l\'utilisateur'
        ];
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
     *             ref="#/components/schemas/Utilisateur"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur mis à jour",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function updateUtilisateur($data, $id)
    {
        $database = DatabaseHandler::connexion();
        $utilisateur = new UtilisateurEntities($data);
        $utilisateur->setIdUtilisateur($id);
        $success = $utilisateur->updateUtilisateur($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Utilisateur mis à jour avec succès' : 'Erreur lors de la mise à jour de l\'utilisateur'
        ];
    }
}
