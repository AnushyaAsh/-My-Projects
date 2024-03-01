package com.example.demo.Controller;


import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;

import com.example.demo.Model.Product;
import com.example.demo.Repository.ProductRepository;

@Controller
public class ProductController {
	@Autowired
	private ProductRepository productRepository;

	@GetMapping("/addproduct")
    public String addProduct( Model model) {
		model.addAttribute("message" );
        return "addproduct";
    }
	@PostMapping("/addproduct")
	public String addProduct(@ModelAttribute Product product, Model model) {
		
		Product n = new Product();
	    n.setName(product.getName());
	    n.setDescription(product.getDescription());
	    n.setPrice(product.getPrice());
	    n.setExpirydate(product.getExpirydate());
	    productRepository.save(n);
	    model.addAttribute("message", "This product " +product.getName() +" is added successfully");
	    return "addproduct";
	}
	
	@GetMapping("/all")
	public String getAllUsers(Model model) {
		Iterable<Product> product = productRepository.findAll();
		model.addAttribute("product",product);
		return "list";

	}

	@GetMapping("/select/{name}")
	public String getSpecificUser(@PathVariable String name, Model model) {
		Product productdetails = productRepository.findByName(name);
		model.addAttribute("productdetails",productdetails);
		return "productDetails";

	}

	@GetMapping("/update/{id}")
    public String showUpdateProductForm(@PathVariable Long id, Model model) {
        Optional<Product>product = productRepository.findById(id);
    	Product productdetails = product.get();

		model.addAttribute("productdetails",productdetails);
        return "updateproduct";
    }

	@PostMapping("/update/{id}")
	public String updateUser(@PathVariable Long id, String name, String description, int price ,String expirydate,Model model) {

		Optional<Product> optionalproductdetails = productRepository.findById(id);
		Product productdetails = optionalproductdetails.get();
		productdetails.setName(name);
		productdetails.setDescription(description);
		productdetails.setPrice(price);
		productdetails.setExpirydate(expirydate);
		productRepository.save(productdetails);
		return "redirect:/all";
	}


	@GetMapping("/delete/{id}")
	public String deleteUser(@PathVariable long id,Model model) {  
		Optional<Product> optionalproductdetails = productRepository.findById(id);
		Product product = optionalproductdetails.get();
		model.addAttribute("product",product);
		return "deleteproduct";
	}

    @PostMapping("/delete/{id}")
	public String deleteUser(String name,Model model) {    
		if (name != null && !name.isEmpty()) {
			Product product = productRepository.findByName(name);
			productRepository.delete(product);
			return "redirect:/all";
		}
		return "deleteproduct";
	}
    @GetMapping("/search")
	public String getAllUsers(Model model , @Param("keyword") String keyword) {
		Iterable<Product> product = productRepository.findAll(keyword);
		model.addAttribute("product",product);
		return "list";

	}
    
    
}
