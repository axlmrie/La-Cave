<?php

namespace src\entities;

class FamilleEntities {

    public $id_famille;
    public $cepage;
    public $annee;
    public $vignoble;

    public function __construct($data = []){
        $this->id_famille = $data['id_famille'] ?? null;
        $this->cepage = $data['cepage'] ?? '';
        $this->annee = $data['annee'] ?? '';
        $this->vignoble = $data['vignoble'] ?? '';

    }


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

    public function createFamille($database)
    {
        $req = $database->prepare("INSERT INTO famille (cepage, annee, vignoble) VALUES (:cepage, :annee, :vignoble)");

        $req->bindParam(":cepage", $this->cepage);
        $req->bindParam(":annee", $this->annee);
        $req->bindParam(":vignoble", $this->vignoble);

        $req->execute();

        return $req->rowCount() == 1;
    }

    public function updateFamille($database)
    {
        $req = $database->prepare("
        UPDATE famille 
        SET cepage = :cepage,
            annee = :annee,
            vignoble = :vignoble
        WHERE id_famille = :id_famille
    ");

        $req->bindParam(":cepage", $this->cepage);
        $req->bindParam(":annee", $this->annee);
        $req->bindParam(":vignoble", $this->vignoble);
        $req->bindParam(":id_famille", $this->id_famille);


        $req->execute();

        return $req->rowCount();
    }

    public static function readFamille($database)
    {
        $req = $database->prepare("SELECT * FROM famille");
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);

    }


}
