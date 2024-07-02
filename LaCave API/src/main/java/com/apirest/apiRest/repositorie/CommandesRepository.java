

package com.apirest.apiRest.repositorie;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Commandes;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.time.LocalDate;
import java.util.Optional;

public interface CommandesRepository extends JpaRepository<Commandes, Long> {
    Optional<Commandes> findByIdCommande(Long idCommande);
    @Query(value = "UPDATE commandes SET date_suppression = :date WHERE id_commande = :id", nativeQuery = true)
    void deleteDate(@Param("id") int id, @Param("date") LocalDate date);

    @Query(value = "SELECT * FROM commandes WHERE client = :client AND date_suppression is NULL", nativeQuery = true)
    Iterable<Commandes> findByClient(@Param("client") int client);

}