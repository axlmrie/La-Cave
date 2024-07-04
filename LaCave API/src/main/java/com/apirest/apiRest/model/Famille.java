package com.apirest.apiRest.model;


import jakarta.persistence.*;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import java.sql.Date;

@Entity
@Table(name = "famille")
@Getter
@Setter
@NoArgsConstructor
public class Famille {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int idFamille;
    private String cepage;
    private String vignoble;
    private int annee;
}
