package com.example.demo.Repository;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;

import com.example.demo.Model.Product;
import com.example.demo.Model.ApplicationUser;

@Repository
public interface ProductRepository extends JpaRepository<Product, Long> {

	Product findByName (String name);
	@Query("SELECT p FROM Product p WHERE p.name LIKE ?1%")
	public List<Product> findAll(String keyword);
}
