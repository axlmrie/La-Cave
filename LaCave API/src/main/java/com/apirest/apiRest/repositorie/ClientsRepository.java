package com.apirest.apiRest.repositorie;

import com.apirest.apiRest.model.Clients;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

public interface ClientsRepository extends JpaRepository<Clients, Long> {

    @Query(value = "SELECT * FROM clients WHERE mail = :email AND password = :password", nativeQuery = true)
    Clients login(@Param("email") String email, @Param("password") String password);
}