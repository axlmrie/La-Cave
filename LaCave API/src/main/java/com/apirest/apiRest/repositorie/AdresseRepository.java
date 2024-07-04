package com.apirest.apiRest.repositorie;

import com.apirest.apiRest.model.Adresse;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.time.LocalDate;
import java.util.Optional;

public interface AdresseRepository extends JpaRepository< Adresse , Long> {


    Optional<Adresse> findByIdAdresse(Long idAdresse);
}
