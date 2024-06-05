<?php

namespace src\entities;

class ArticleEntities
{
    public $id_article;
    public $designation;
    public $famille;
    public $prix;
    public $stock;
    public $conditionnement;
    public $reference;

    public function __construct($datas =[]){
        $this->id_article = $datas['id_article'] ?? null;
        $this->designation = $datas['designation'] ?? '';
        $this->famille = $datas['famille'] ?? '';
        $this->prix = $datas['prix'] ?? 0;
        $this->stock = $datas['stock'] ?? 0;
        $this->conditionnement = $datas['conditionnement'] ?? '';
        $this->reference = $datas['reference'] ?? '';
    }


    public function getReference()
    {
        return $this->reference;
    }


    public function setReference($reference): void
    {
        $this->reference = $reference;
    }


    public function getIdArticle()
    {
        return $this->id_article;
    }


    public function setIdArticle($id_article): void
    {
        $this->id_article = $id_article;
    }


    public function getDesignation()
    {
        return $this->designation;
    }


    public function setDesignation($designation): void
    {
        $this->designation = $designation;
    }


    public function getFamille()
    {
        return $this->famille;
    }


    public function setFamille($famille): void
    {
        $this->famille = $famille;
    }


    public function getPrix()
    {
        return $this->prix;
    }


    public function setPrix($prix): void
    {
        $this->prix = $prix;
    }


    public function getStock()
    {
        return $this->stock;
    }


    public function setStock($stock): void
    {
        $this->stock = $stock;
    }


    public function getConditionnement()
    {
        return $this->conditionnement;
    }


    public function setConditionnement($conditionnement): void
    {
        $this->conditionnement = $conditionnement;
    }

    public static function readArticle($database)
    {
        $req = $database->prepare('SELECT * FROM articles WHERE stock > 1');
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function articleFamille($database)
    {
        $req = $database->prepare('Select * from articles INNER JOIN famille ON articles.famille = famille.id_famille');
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function stockArticleNeg($database)
    {
        $req = $database->prepare('SELECT * FROM articles WHERE stock < 1');
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateStock($database)
    {
        $req = $database->prepare('
        UPDATE articles 
        SET stock = :stock 
        WHERE id_article :id_article');

        $req->bindParam(":stock", $this->stock);
        $req->bindParam(":id_article", $this->id_article);
        $req->execute();
        return $req;
    }

    public function createArticle($database)
    {
        $req = $database->prepare("
        INSERT INTO articles (designation, famille, prix, stock, conditionnement, reference) VALUES (:designation, :famille, :prix, :stock, :conditionnement, :reference)");

        $req->bindParam(":designation", $this->designation);
        $req->bindParam(":famille", $this->famille);
        $req->bindParam(":prix", $this->prix);
        $req->bindParam(":stock", $this->stock);
        $req->bindParam(":conditionnement", $this->conditionnement);
        $req->bindParam(":reference", $this->reference);

        $req->execute();

        return $req;
    }

    public function updateArticle($database)
    {
        $req = $database->prepare('
        UPDATE articles 
        SET designation = :designation,
            famille = :famille,
            prix = :prix,
            stock = :stock,
            conditionnement = :conditionnement,
            reference = :reference
        WHERE id_article = :id_article');

        $req->bindParam(":designation", $this->designation);
        $req->bindParam(":famille", $this->famille);
        $req->bindParam(":prix", $this->prix);
        $req->bindParam(":stock", $this->stock);
        $req->bindParam(":conditionnement", $this->conditionnement);
        $req->bindParam(":reference", $this->reference);
        $req->bindParam(":id_article", $this->id_article);

        $req->execute();
        return $req;
    }






}