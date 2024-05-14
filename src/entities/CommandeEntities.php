<?php

namespace src\entities;

class CommandeEntities {
    public $id_commande;
    public $article;
    public $quantite;
    public $fournisseur;
    public $date_commande;
    public $date_suppression;
    public $client;

    /**
     * @return mixed
     */
    public function getIdCommande()
    {
        return $this->id_commande;
    }

    /**
     * @param mixed $id_commande
     */
    public function setIdCommande($id_commande): void
    {
        $this->id_commande = $id_commande;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article): void
    {
        $this->article = $article;
    }

    /**
     * @return mixed
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param mixed $quantite
     */
    public function setQuantite($quantite): void
    {
        $this->quantite = $quantite;
    }

    /**
     * @return mixed
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * @param mixed $fournisseur
     */
    public function setFournisseur($fournisseur): void
    {
        $this->fournisseur = $fournisseur;
    }

    /**
     * @return mixed
     */
    public function getDateCommande()
    {
        return $this->date_commande;
    }

    /**
     * @param mixed $date_commande
     */
    public function setDateCommande($date_commande): void
    {
        $this->date_commande = $date_commande;
    }

    /**
     * @return mixed
     */
    public function getDateSuppression()
    {
        return $this->date_suppression;
    }

    /**
     * @param mixed $date_suppression
     */
    public function setDateSuppression($date_suppression): void
    {
        $this->date_suppression = $date_suppression;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client): void
    {
        $this->client = $client;
    }


}
