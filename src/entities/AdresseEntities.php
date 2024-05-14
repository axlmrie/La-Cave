<?php

namespace src\entities;

class AdresseEntities {
    public $id_adresse;
    public $nom_rue;
    public $numero_rue;
    public $ville;
    public $code_postal;
    public $pays;
    public $facturation;

    public function __construct(){
        $this->id_adresse = "";
        $this->nom_rue = "";
        $this->numero_rue = "";
        $this->ville = "";
        $this->code_postal = "";
        $this->pays = "";
        $this->facturation = "";
    }


    public function getIdAdresse()
    {
        return $this->id_adresse;
    }


    public function setIdAdresse($id_adresse): void
    {
        $this->id_adresse = $id_adresse;
    }


    public function getNomRue()
    {
        return $this->nom_rue;
    }


    public function setNomRue($nom_rue): void
    {
        $this->nom_rue = $nom_rue;
    }


    public function getNumeroRue()
    {
        return $this->numero_rue;
    }


    public function setNumeroRue($numero_rue): void
    {
        $this->numero_rue = $numero_rue;
    }

    public function getVille()
    {
        return $this->ville;
    }


    public function setVille($ville): void
    {
        $this->ville = $ville;
    }


    public function getCodePostal()
    {
        return $this->code_postal;
    }


    public function setCodePostal($code_postal): void
    {
        $this->code_postal = $code_postal;
    }


    public function getPays()
    {
        return $this->pays;
    }


    public function setPays($pays): void
    {
        $this->pays = $pays;
    }


    public function getFacturation()
    {
        return $this->facturation;
    }


    public function setFacturation($facturation): void
    {
        $this->facturation = $facturation;
    }


}