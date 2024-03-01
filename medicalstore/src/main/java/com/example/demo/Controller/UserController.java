package com.example.demo.Controller;

import java.security.Principal;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;

import com.example.demo.Service.UserService;
import com.example.demo.dto.UserDto;

@Controller
public class UserController {
	
	@Autowired
	UserDetailsService userDetailsService;

	@Autowired
	private UserService userService;
	
	
	@GetMapping("/registration")
	public String getRegistrationPage(@ModelAttribute("user") UserDto userDto) {
		return "register";
	}
	
	@PostMapping("/registration")
	public String saveUser(@ModelAttribute("user") UserDto userDto, @RequestParam("confirmPassword") String confirmPassword, BindingResult result, Model model) {
	    if (!userDto.getPassword().equals(confirmPassword)) {
	    	model.addAttribute("error", "Password and confirmation password do not match.");
	        return "register"; 
	    }
	    else {
	    userService.save(userDto);
	    model.addAttribute("message", "User registered successfully.");
	    return "redirect:/login";
	    }
	}

	@GetMapping("/login")
	public String login() {
		return "login";
	}
	@GetMapping("/user-page")
	public String userPage (Model model, Principal principal) {
		UserDetails userDetails = userDetailsService.loadUserByUsername(principal.getName());
		model.addAttribute("user", userDetails);
		return "user";
	}
	
	@GetMapping("/admin-page")
	public String adminPage (Model model, Principal principal) {
		UserDetails userDetails = userDetailsService.loadUserByUsername(principal.getName());
		model.addAttribute("user", userDetails);
		return "admin";
	}
	

}
