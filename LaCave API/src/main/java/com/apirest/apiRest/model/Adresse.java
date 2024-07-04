package com.apirest.apiRest.model;


import jakarta.persistence.*;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;

import java.sql.Date;

@Entity
@Table(name = "adresse")
@Getter
@Setter
@NoArgsConstructor
public class Adresse {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id_adresse")
    private int idAdresse;
    private String nom_rue;
    private int numero_rue;
    private String ville;
    private String code_postal;
    private String pays;
    private Byte facturation;
}
