package com.vit.results.model;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import lombok.Data;

@Entity
@Data
public class Student {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String name;
    private String rollNo;
    private float subject1Mse;
    private float subject1Ese;
    private float subject2Mse;
    private float subject2Ese;
    private float subject3Mse;
    private float subject3Ese;
    private float subject4Mse;
    private float subject4Ese;
}
