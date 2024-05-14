<?php

namespace src\entities;

class FournisseurEntities {
    public $id_fournisseur;
    public $nom;
    public $adresse;
    public $date_suppression;
    public $numero_telephone;

    public function __construct(){
        $this->id_fournisseur = "";
        $this->nom = "";
        $this->adresse = "";
        $this->date_suppression = "";
        $this->numero_telephone = "";
    }

    /**
     * @return mixed
     */
    public function getIdFournisseur()
    {
        return $this->id_fournisseur;
    }

    /**
     * @param mixed $id_fournisseur
     */
    public function setIdFournisseur($id_fournisseur): void
    {
        $this->id_fournisseur = $id_fournisseur;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse): void
    {
        $this->adresse = $adresse;
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
    public function getNumeroTelephone()
    {
        return $this->numero_telephone;
    }

    /**
     * @param mixed $numero_telephone
     */
    public function setNumeroTelephone($numero_telephone): void
    {
        $this->numero_telephone = $numero_telephone;
    }


}
