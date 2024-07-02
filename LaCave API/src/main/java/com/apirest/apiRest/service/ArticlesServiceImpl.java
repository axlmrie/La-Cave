package com.apirest.apiRest.service;

import org.springframework.transaction.annotation.Transactional;
import com.apirest.apiRest.model.Articles;
import com.apirest.apiRest.repositorie.ArticlesRepository;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;


@Service
@AllArgsConstructor
public class ArticlesServiceImpl implements ArticlesService {

    private final ArticlesRepository articlesRepository;





    @Override
    public List<Articles> getAll() {
        return articlesRepository.findAll();
    }

    @Override
    public Articles findByIdArticles(Long idArticles) {
        Optional<Articles> optionalArticles = articlesRepository.findById(idArticles);
        return optionalArticles.orElse(null);
    }
    @Override
    public Iterable<Articles> findByIdFamille() {
        return articlesRepository.findByIdFamille();
    }

    @Override
    @Transactional
    public void modifyStock(int id, int stock) {
        articlesRepository.modifyStock(id, stock);
    }

    @Override
    public Articles modifyArticles(int id, Articles articles) {
        return articlesRepository.findById((long) id)
                .map(p -> {
                    p.setConditionnement(articles.getConditionnement());
                    p.setPrix(articles.getPrix());
                    p.setDesignation(articles.getDesignation());
                    p.setFamille(articles.getFamille());
                    p.setReference(articles.getReference());
                    p.setStock(articles.getStock());
                    return articlesRepository.save(p);
                }).orElseThrow(()-> new RuntimeException("Adresse introuvable"));
    }

    @Override
    public Articles createArticles(Articles articles) {
        return articlesRepository.save(articles);
    }

    @Override
    public Iterable<Articles> stockArticleNeg() {
        return articlesRepository.stockArticleNeg();
    }











}