<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\CommandeEntities;
use src\handlers\DatabaseHandler;

class CommandeModels {

    /**
     * @OA\Get(
     *     path="/commandes/readCommandes",
     *     tags={"Commandes"},
     *     summary="Lire les commandes",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des commandes",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Commande")
     *         )
     *     )
     * )
     */
    public static function readCommandes()
    {
        $database = DatabaseHandler::connexion();
        return CommandeEntities::readCommandes($database);
    }

    /**
     * @OA\Post(
     *     path="/commandes/createCommande",
     *     tags={"Commandes"},
     *     summary="Créer une nouvelle commande",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Commande"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Commande créée",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function createCommande($data)
    {
        $database = DatabaseHandler::connexion();
        $commande = new CommandeEntities($data);
        $success = $commande->createCommande($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Commande créée avec succès' : 'Erreur lors de la création de la commande'
        ];
    }

    /**
     * @OA\Put(
     *     path="/commandes/deleteCommande/{id}",
     *     tags={"Commandes"},
     *     summary="Supprimer une commande existante",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID de la commande à supprimer"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Commande"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Commande supprimée",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function deleteCommande($data, $id)
    {
        $database = DatabaseHandler::connexion();
        $commande = new CommandeEntities($data);
        $commande->setIdCommande($id);
        $commande->setDateSuppression(date('Y-m-d H:i:s'));
        $success = $commande->deleteCommande($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Commande supprimée avec succès' : 'Erreur lors de la suppression de la commande'
        ];
    }

    /**
     * @OA\Get(
     *     path="/commandes/affichageCommandes",
     *     tags={"Commandes"},
     *     summary="Afficher les commandes avec détails",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des commandes avec détails",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Commande")
     *         )
     *     )
     * )
     */
    public static function affichageCommandes()
    {
        $database = DatabaseHandler::connexion();
        return CommandeEntities::affichageCommandes($database);
    }
}