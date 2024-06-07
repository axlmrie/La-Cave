<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\CommandeModels;

class CommandeController {

    /**
     * @OA\Get(
     *     path="/commandes/readCommandes",
     *     tags={"Commandes"},
     *     summary="Obtenir toutes les commandes",
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
    public static function readCommandes(Request $request, Response $response, $args)
    {
        $results = CommandeModels::readCommandes($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    /**
     * @OA\Post(
     *     path="/commandes/createCommandes",
     *     tags={"Commandes"},
     *     summary="Créer une nouvelle commande",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="article", type="integer"),
     *             @OA\Property(property="quantite", type="integer"),
     *             @OA\Property(property="fournisseur", type="integer"),
     *             @OA\Property(property="date_commande", type="string", format="date-time"),
     *             @OA\Property(property="date_suppression", type="string", format="date-time"),
     *             @OA\Property(property="client", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Commande créée",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function createCommandes(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $results = CommandeModels::createCommande($data);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    /**
     * @OA\Get(
     *     path="/commandes/affichageCommandes",
     *     tags={"Commandes"},
     *     summary="Afficher les commandes avec les détails",
     *     @OA\Response(
     *         response=200,
     *         description="Détails des commandes",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/CommandeDetail")
     *         )
     *     )
     * )
     */
    public static function affichageCommandes(Request $request, Response $response, $args)
    {
        $results = CommandeModels::affichageCommandes($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    /**
     * @OA\Put(
     *     path="/commandes/deleteCommande/{id}",
     *     tags={"Commandes"},
     *     summary="Supprimer une commande en mettant à jour la date de suppression",
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
     *             type="object",
     *             @OA\Property(property="date_suppression", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Commande supprimée",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function deleteCommandes(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $results = CommandeModels::deleteCommande($data, $id);
        return ResponseHandler::Response($request, $response, (array)$results);
    }
}
