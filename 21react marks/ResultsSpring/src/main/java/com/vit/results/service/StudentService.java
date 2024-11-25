package com.vit.results.service;

import java.util.List;

import org.springframework.stereotype.Service;

import com.vit.results.model.Student;
import com.vit.results.repository.StudentRepository;

@Service
public class StudentService {
    private final StudentRepository studentRepository;

    public StudentService(StudentRepository studentRepository) {
        this.studentRepository = studentRepository;
    }

    public List<Student> getAllStudents() {
        return studentRepository.findAll();
    }

    public Student saveStudent(Student student) {
        return studentRepository.save(student);
    }

    public Student getStudentByRollNo(String rollNo) {
        return studentRepository.findByRollNo(rollNo);
    }
}
