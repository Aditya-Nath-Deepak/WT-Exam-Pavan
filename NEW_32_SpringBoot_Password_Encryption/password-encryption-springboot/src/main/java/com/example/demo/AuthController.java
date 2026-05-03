package com.example.demo;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;
import org.springframework.security.core.Authentication;

@RestController
public class AuthController {

    @Autowired
    private UserRepository userRepository;

    @Autowired
    private PasswordEncoder passwordEncoder;

    @PostMapping("/register")
    public String register(@RequestParam String username, @RequestParam String password) {
        if (userRepository.findByUsername(username).isPresent()) {
            return "User already exists";
        }
        User user = new User();
        user.setUsername(username);
        // Task 2: Store encrypted passwords in database
        user.setPassword(passwordEncoder.encode(password));
        userRepository.save(user);
        return "User registered successfully! Password has been encrypted with BCrypt and stored.";
    }

    @GetMapping("/home")
    public String home(Authentication authentication) {
        // Task 5: Display authentication results
        return "Authentication successful for user: " + authentication.getName() + "!";
    }
}
