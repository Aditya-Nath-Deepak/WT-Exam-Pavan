package com.bookstore.controller;

import com.bookstore.model.Book;
import com.bookstore.model.User;
import com.bookstore.repository.BookRepository;
import com.bookstore.repository.UserRepository;
import jakarta.annotation.PostConstruct;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;

@Controller
public class BookStoreController {

    @Autowired
    private UserRepository userRepository;

    @Autowired
    private BookRepository bookRepository;

    @PostConstruct
    public void init() {
        if (bookRepository.count() == 0) {
            bookRepository.save(new Book("The Great Gatsby", "F. Scott Fitzgerald", 10.99, "https://via.placeholder.com/150"));
            bookRepository.save(new Book("1984", "George Orwell", 8.99, "https://via.placeholder.com/150"));
            bookRepository.save(new Book("To Kill a Mockingbird", "Harper Lee", 12.50, "https://via.placeholder.com/150"));
            bookRepository.save(new Book("Moby Dick", "Herman Melville", 15.00, "https://via.placeholder.com/150"));
        }
    }

    @GetMapping("/")
    public String home() {
        return "home";
    }

    @GetMapping("/login")
    public String loginPage() {
        return "login";
    }

    @PostMapping("/login")
    public String login(@ModelAttribute User user, Model model) {
        User existingUser = userRepository.findByUsername(user.getUsername());
        if (existingUser != null && existingUser.getPassword().equals(user.getPassword())) {
            return "redirect:/catalog";
        }
        model.addAttribute("error", "Invalid username or password");
        return "login";
    }

    @GetMapping("/register")
    public String registerPage(Model model) {
        model.addAttribute("user", new User());
        return "register";
    }

    @PostMapping("/register")
    public String register(@ModelAttribute User user, Model model) {
        if (userRepository.findByUsername(user.getUsername()) != null) {
            model.addAttribute("error", "Username already exists");
            return "register";
        }
        userRepository.save(user);
        return "redirect:/login";
    }

    @GetMapping("/catalog")
    public String catalogPage(Model model) {
        model.addAttribute("books", bookRepository.findAll());
        return "catalog";
    }
}
