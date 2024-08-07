

package com.apirest.apiRest.service;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Articles;
import com.apirest.apiRest.model.Utilisateurs;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;
import java.time.LocalDate;

public interface ArticlesService {
    List<Articles> getAll();
    Articles findByIdArticles(Long idArticles);
    Iterable<Articles> findByIdFamille();
    Articles createArticles(Articles articles);
    Iterable<Articles> stockArticleNeg();

    @Transactional
    void modifyStock(int id, int stock);

    Articles modifyArticles(int id, Articles articles);







}