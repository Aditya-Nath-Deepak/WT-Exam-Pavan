package com.example.myapp.service;

import com.example.myapp.model.Product;
import com.example.myapp.repository.ProductRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class ProductService {

    @Autowired
    private ProductRepository repo;

    public Product save(Product product) {
        return repo.save(product);
    }

    public List<Product> getAll() {
        return repo.findAll();
    }

    public Product getById(String id) {
        return repo.findById(id).orElse(null);
    }

    public Product update(String id, Product product) {
        product.setId(id);
        return repo.save(product);
    }

    public void delete(String id) {
        repo.deleteById(id);
    }
}