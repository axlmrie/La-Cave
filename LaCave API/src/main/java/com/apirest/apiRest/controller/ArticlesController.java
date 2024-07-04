package com.apirest.apiRest.controller;

import com.apirest.apiRest.model.Adresse;
import com.apirest.apiRest.model.Articles;
import com.apirest.apiRest.model.Utilisateurs;
import com.apirest.apiRest.service.AdresseService;
import com.apirest.apiRest.service.ArticlesService;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/articles")
@AllArgsConstructor
public class ArticlesController {
    private final ArticlesService articlesService;

    @GetMapping("/FindAll")
    public List<Articles> getAll() {
        return articlesService.getAll();
    }

    @PutMapping("/{id}/stock/{stock}")
    public String modifyStock(@PathVariable int id, @PathVariable int stock) {
        articlesService.modifyStock(id, stock);
        return "Changement effectué";

    }

    @GetMapping("/findById/{id}")
    public ResponseEntity<Articles> getArticlesById(@PathVariable Long id) {
        Articles articles = articlesService.findByIdArticles(id);
        if (articles != null) {
            return ResponseEntity.ok(articles);
        } else {
            return ResponseEntity.notFound().build();
        }
    }

    @PostMapping("/create")
    public Articles create(@RequestBody Articles articles) {
        return articlesService.createArticles(articles);
    }

    @GetMapping("/stockArticleNeg")
    public Iterable<Articles> stockArticleNeg() {
        return articlesService.stockArticleNeg();
    }
    @GetMapping("/findByIdFamille")
    public Iterable<Articles> findByIdFamille() {
        return articlesService.findByIdFamille();
    }

    @PutMapping("/update/{id}")
    public Articles update (@PathVariable int id, @RequestBody Articles articles) {
        return articlesService.modifyArticles(id, articles);
    }


}
