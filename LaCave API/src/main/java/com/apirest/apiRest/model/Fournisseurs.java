package com.apirest.apiRest.model;


import jakarta.persistence.*;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import java.sql.Date;

@Entity
@Table(name = "fournisseurs")
@Getter
@Setter
@NoArgsConstructor
public class Fournisseurs {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int idFournisseurs;
    private String numero_tel;
    private String nom;
    private Date date_suppression;
    @ManyToOne
    @JoinColumn(name = "adresse", nullable = true)
    private Adresse adresse;
}
