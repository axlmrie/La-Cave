package com.apirest.apiRest.service;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Articles;
import com.apirest.apiRest.model.Famille;
import com.apirest.apiRest.model.Fournisseurs;

import java.util.List;
import java.time.LocalDate;

public interface FournisseursService {
    Fournisseurs findByIdFournisseurs(Long idFournisseurs);
    Fournisseurs modifyFournisseurs(int id, Fournisseurs fournisseurs);
    Fournisseurs createFournisseurs(Fournisseurs fournisseurs);


}
