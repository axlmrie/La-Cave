<?php

namespace src\entities;

class ArticleEntities {

    public $id_article;
    public $designation;
    public $famille;
    public $prix;
    public $stock;
    public $conditionnement;
    public $reference;


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


}