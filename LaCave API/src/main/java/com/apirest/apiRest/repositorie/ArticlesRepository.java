package com.apirest.apiRest.repositorie;


import com.apirest.apiRest.model.Articles;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;


import java.time.LocalDate;
import java.util.Optional;

public interface ArticlesRepository extends JpaRepository<Articles, Long> {
    @Query(value = "SELECT * FROM articles WHERE stock < 1", nativeQuery = true)
    Iterable<Articles> stockArticleNeg();

    @Query(value = "Select * from articles INNER JOIN famille ON articles.famille = famille.id_famille", nativeQuery = true)
    Iterable<Articles> findByIdFamille();
    @Modifying
    @Transactional
    @Query(value = "UPDATE Articles a SET a.stock = :stock WHERE a.idArticle = :id")
    void modifyStock(int id, int stock);
}
