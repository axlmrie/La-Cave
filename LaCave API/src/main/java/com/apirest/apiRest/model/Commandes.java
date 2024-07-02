package com.apirest.apiRest.model;


import jakarta.persistence.*;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;
import java.sql.Timestamp;


import java.sql.Date;

@Entity
@Table(name = "commandes")
@Getter
@Setter
@NoArgsConstructor
public class Commandes {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int idCommande;
    @ManyToOne
    @JoinColumn(name = "article", nullable = true)
    private Articles article;
    private int quantite;
    @ManyToOne
    @JoinColumn(name = "client", nullable = true)
    private Clients client;
    @ManyToOne
    @JoinColumn(name = "fournisseur", nullable = true)
    private Fournisseurs fournisseur;

    private Timestamp date_commande;
    private Date date_suppression;


}
