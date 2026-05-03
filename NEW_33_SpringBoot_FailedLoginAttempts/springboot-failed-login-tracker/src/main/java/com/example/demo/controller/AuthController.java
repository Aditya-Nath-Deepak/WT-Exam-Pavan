package com.example.demo.controller;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpSession;
import org.springframework.security.core.AuthenticationException;
import org.springframework.security.web.WebAttributes;

@Controller
public class AuthController {

    @GetMapping("/login")
    public String login(HttpServletRequest request, Model model) {
        HttpSession session = request.getSession(false);
        String errorMessage = null;
        if (session != null) {
            errorMessage = (String) session.getAttribute("errorMessage");
            if (errorMessage == null) {
                AuthenticationException ex = (AuthenticationException) session
                        .getAttribute(WebAttributes.AUTHENTICATION_EXCEPTION);
                if (ex != null) {
                    errorMessage = ex.getMessage();
                }
            } else {
                session.removeAttribute("errorMessage");
            }
        }
        model.addAttribute("errorMessage", errorMessage);
        return "login";
    }

    @GetMapping("/home")
    public String home() {
        return "home";
    }
    
    @GetMapping("/")
    public String index() {
        return "redirect:/home";
    }
}
