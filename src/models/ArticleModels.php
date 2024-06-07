<?php

namespace src\models;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\entities\ArticleEntities;
use src\handlers\DatabaseHandler;

class ArticleModels {

    /**
     * @OA\Get(
     *     path="/articles/readArticle",
     *     tags={"Articles"},
     *     summary="Lire les articles",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des articles",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Article")
     *         )
     *     )
     * )
     */
    public static function readArticle()
    {
        $database = DatabaseHandler::connexion();
        return ArticleEntities::readArticle($database);
    }

    /**
     * @OA\Get(
     *     path="/articles/stockArticleNeg",
     *     tags={"Articles"},
     *     summary="Lire les articles avec stock négatif",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des articles avec stock négatif",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Article")
     *         )
     *     )
     * )
     */
    public static function stockArticleNeg()
    {
        $database = DatabaseHandler::connexion();
        return ArticleEntities::stockArticleNeg($database);
    }

    /**
     * @OA\Get(
     *     path="/articles/articleFamille",
     *     tags={"Articles"},
     *     summary="Lire les articles avec leurs familles",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des articles avec leurs familles",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Article")
     *         )
     *     )
     * )
     */
    public static function articleFamille()
    {
        $database = DatabaseHandler::connexion();
        return ArticleEntities::articleFamille($database);
    }

    /**
     * @OA\Post(
     *     path="/articles/createArticle",
     *     tags={"Articles"},
     *     summary="Créer un nouvel article",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Article"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Article créé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function createArticle($data)
    {
        $database = DatabaseHandler::connexion();
        $article = new ArticleEntities($data);
        $success = $article->createArticle($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Article créé avec succès' : 'Erreur lors de la création de l\'article'
        ];
    }

    /**
     * @OA\Put(
     *     path="/articles/updateArticle/{id}",
     *     tags={"Articles"},
     *     summary="Mettre à jour un article existant",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID de l'article à mettre à jour"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Article"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Article mis à jour",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public static function updateArticle($data, $id)
    {
        $database = DatabaseHandler::connexion();
        $article = new ArticleEntities($data);
        $article->setIdArticle($id);
        $success = $article->updateArticle($database);
        return [
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Article mis à jour avec succès' : 'Erreur lors de la mise à jour de l\'article'
        ];
    }
}