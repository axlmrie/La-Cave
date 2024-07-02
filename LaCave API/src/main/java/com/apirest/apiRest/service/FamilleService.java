package com.apirest.apiRest.service;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Articles;
import com.apirest.apiRest.model.Famille;

import java.util.List;
import java.time.LocalDate;

public interface FamilleService {

    Famille findByIdFamille(Long idFamille);
    Famille modifyFamille(int id, Famille famille);
    Famille createFamille(Famille famille);

}
