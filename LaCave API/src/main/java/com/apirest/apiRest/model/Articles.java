package com.apirest.apiRest.model;


import jakarta.persistence.*;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import java.sql.Date;

@Entity
@Table(name = "articles")
@Getter
@Setter
@NoArgsConstructor
public class Articles {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int idArticle;
    private String reference;
    private String designation;
    private String conditionnement;
    private int stock;
    private int prix;
    @ManyToOne
    @JoinColumn(name = "famille", nullable = true)
    private Famille famille;

}
