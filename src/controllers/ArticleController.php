<?php

namespace src\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\handlers\ResponseHandler;
use src\models\ArticleModels;

class ArticleController {

    /**
     * @OA\Get(
     *     path="/articles/readArticle",
     *     tags={"Articles"},
     *     summary="Obtenir tous les articles",
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
    public static function readArticle(Request $request, Response $response, $args)
    {
        $results = ArticleModels::readArticle($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    /**
     * @OA\Get(
     *     path="/articles/stockArticleNeg",
     *     tags={"Articles"},
     *     summary="Obtenir les articles avec un stock négatif",
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
    public static function stockArticleNeg(Request $request, Response $response, $args)
    {
        $results = ArticleModels::stockArticleNeg($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    /**
     * @OA\Get(
     *     path="/articles/articleFamille",
     *     tags={"Articles"},
     *     summary="Obtenir les articles avec leur famille",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des articles avec leur famille",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Article")
     *         )
     *     )
     * )
     */
    public static function articleFamille(Request $request, Response $response, $args)
    {
        $results = ArticleModels::articleFamille($request, $response, $args);
        return ResponseHandler::Response($request, $response, (array)$results);
    }

    /**
     * @OA\Post(
     *     path="/articles/createArticle",
     *     tags={"Articles"},
     *     summary="Créer un nouvel article",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="designation", type="string"),
     *             @OA\Property(property="famille", type="integer"),
     *             @OA\Property(property="prix", type="number", format="float"),
     *             @OA\Property(property="stock", type="integer"),
     *             @OA\Property(property="conditionnement", type="string"),
     *             @OA\Property(property="reference", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Article créé",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function createArticle(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $results = ArticleModels::createArticle($data);
        return ResponseHandler::Response($request, $response, (array)$results);
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
     *             type="object",
     *             @OA\Property(property="designation", type="string"),
     *             @OA\Property(property="famille", type="integer"),
     *             @OA\Property(property="prix", type="number", format="float"),
     *             @OA\Property(property="stock", type="integer"),
     *             @OA\Property(property="conditionnement", type="string"),
     *             @OA\Property(property="reference", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Article mis à jour",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string"),
     *             @OA\Property(property="datas", type="object")
     *         )
     *     )
     * )
     */
    public static function updateArticle(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $args['id'];
        $results = ArticleModels::updateArticle($data, $id);
        return ResponseHandler::Response($request, $response, (array)$results);
    }
}

