package com.vit.results.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import com.vit.results.model.Student;

public interface StudentRepository extends JpaRepository<Student, Long> {
    Student findByRollNo(String rollNo);
}
