<?php

namespace src\entities;

class ClientEntities {
    public $id_client;
    public $nom;
    public $prenom;
    public $mot_de_passe;
    public $numero_telephone;
    public $adresse_facturation;
    public $adresse_livraison;
    public $date_suppression;


    public function getIdClient()
    {
        return $this->id_client;
    }


    public function setIdClient($id_client): void
    {
        $this->id_client = $id_client;
    }


    public function getNom()
    {
        return $this->nom;
    }


    public function setNom($nom): void
    {
        $this->nom = $nom;
    }


    public function getPrenom()
    {
        return $this->prenom;
    }


    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }


    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }


    public function setMotDePasse($mot_de_passe): void
    {
        $this->mot_de_passe = $mot_de_passe;
    }


    public function getNumeroTelephone()
    {
        return $this->numero_telephone;
    }


    public function setNumeroTelephone($numero_telephone): void
    {
        $this->numero_telephone = $numero_telephone;
    }


    public function getAdresseFacturation()
    {
        return $this->adresse_facturation;
    }


    public function setAdresseFacturation($adresse_facturation): void
    {
        $this->adresse_facturation = $adresse_facturation;
    }


    public function getAdresseLivraison()
    {
        return $this->adresse_livraison;
    }


    public function setAdresseLivraison($adresse_livraison): void
    {
        $this->adresse_livraison = $adresse_livraison;
    }


    public function getDateSuppression()
    {
        return $this->date_suppression;
    }


    public function setDateSuppression($date_suppression): void
    {
        $this->date_suppression = $date_suppression;
    }


}