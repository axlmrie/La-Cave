package com.apirest.apiRest.service;

import com.apirest.apiRest.model.Adresse;
import java.util.List;
import java.time.LocalDate;

public interface AdresseService {

    Adresse findByIdAdresse(Long idAdresse);
    Adresse modifyAdresse(int id, Adresse adresse);
    Adresse createAdresse(Adresse adresse);



}
