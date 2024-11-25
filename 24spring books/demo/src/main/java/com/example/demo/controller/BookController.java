package com.example.demo.controller;

import com.example.demo.model.Book;
import com.example.demo.repository.BookRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PathVariable;



@Controller
public class BookController {

    @Autowired
    private BookRepository bookRepository;

    @GetMapping("/catalogue")
    public String showCatalogue(Model model) {
        model.addAttribute("books", bookRepository.findAll());
        return "catalogue";
    }

    @GetMapping("/book/{id}")
    public String showBookDetails(@PathVariable Long id, Model model) {
        Book book = bookRepository.findById(id).orElseThrow(() -> new RuntimeException("Book not found"));
        model.addAttribute("book", book);
        return "bookdetails";
    }

    @GetMapping("/books/add")
    public String showAddBookPage() {
        return "addbook";
    }

    @PostMapping("/books/add")
    public String addBook(Book book) {
        bookRepository.save(book);
        return "redirect:/catalogue";
    }

    @GetMapping("/books/edit/{id}")
    public String showEditBookPage(@PathVariable Long id, Model model) {
        Book book = bookRepository.findById(id).orElseThrow(() -> new RuntimeException("Book not found"));
        model.addAttribute("book", book);
        return "editbook";
    }

    @PostMapping("/books/edit")
    public String editBook(Book book) {
        bookRepository.save(book);
        return "redirect:/catalogue";
    }
}
