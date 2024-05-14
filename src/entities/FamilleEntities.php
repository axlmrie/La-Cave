<?php

namespace src\entities;

class FamilleEntities {

    public $id_famille;
    public $cepage;
    public $annee;
    public $vignoble;


    public function getIdFamille()
    {
        return $this->id_famille;
    }


    public function setIdFamille($id_famille): void
    {
        $this->id_famille = $id_famille;
    }


    public function getCepage()
    {
        return $this->cepage;
    }


    public function setCepage($cepage): void
    {
        $this->cepage = $cepage;
    }


    public function getAnnee()
    {
        return $this->annee;
    }


    public function setAnnee($annee): void
    {
        $this->annee = $annee;
    }


    public function getVignoble()
    {
        return $this->vignoble;
    }


    public function setVignoble($vignoble): void
    {
        $this->vignoble = $vignoble;
    }


}
