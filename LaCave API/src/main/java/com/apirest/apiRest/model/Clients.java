package com.apirest.apiRest.model;

import jakarta.persistence.*;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import java.sql.Timestamp;

@Entity
@Table(name = "clients")
@Getter
@Setter
@NoArgsConstructor
public class Clients {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int idClient;

    private String numero_tel;
    private String prenom;
    private String nom;
    private String password;
    private String mail;

    @Column(name = "date_suppression")
    private Timestamp dateDeSuppression;

    @ManyToOne
    @JoinColumn(name = "adresse_livraison", referencedColumnName = "id_adresse", nullable = false)
    private Adresse adresse_livraison;

    @ManyToOne
    @JoinColumn(name = "adresse_facturation", referencedColumnName = "id_adresse", nullable = false)
    private Adresse adresse_facturation;

}
