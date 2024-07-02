package com.apirest.apiRest.repositorie;

import com.apirest.apiRest.model.Famille;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface FamilleRepository extends JpaRepository<Famille, Long> {
    Optional<Famille> findByIdFamille(Long idFamille);

}