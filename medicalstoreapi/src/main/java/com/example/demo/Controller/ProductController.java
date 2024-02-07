package com.example.demo.Controller;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.repository.query.Param;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.Model.Product;
import com.example.demo.Repository.ProductRepository;

@RestController

public class ProductController {
	@Autowired
	private ProductRepository productRepository;

	@PostMapping("/create")
	Product newProduct(@RequestBody Product product) {
		return productRepository.save(product);
	}
	@GetMapping("/all")
	List all() {
		return productRepository.findAll();
	}
	@GetMapping("/product/{id}")
	Product withID(@PathVariable Long id) {
		return productRepository.findById(id).orElseThrow();
	}
	
	
	@PutMapping("/update/{id}")
	  Product replaceProduct(@RequestBody Product newProduct, @PathVariable Long id) {
	    
	    return productRepository.findById(id)
	      .map(product -> {
	        product.setName(newProduct.getName());
	        product.setDescription(newProduct.getDescription());
	        product.setPrice(newProduct.getPrice());
	        product.setExpirydate(newProduct.getExpirydate());
	        return productRepository.save(product);
	      })
	      .orElseGet(() -> {
	    	  newProduct.setId(id);
	        return productRepository.save(newProduct);
	      });
	  } 	
	@DeleteMapping("/delete/{id}")
	  String deleteProduct(@PathVariable Long id) {
	    productRepository.deleteById(id);
	    return "Product deleted successfully";
	  }
	 @GetMapping("/search")
		List<Product> getAllUsers(Model model , @Param("keyword") String keyword) {
			Iterable<Product> product = productRepository.findAll(keyword);
			model.addAttribute("product",product);
			return productRepository.findAll(keyword);
			

		}
}
