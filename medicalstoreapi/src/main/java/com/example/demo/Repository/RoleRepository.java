package com.example.demo.Repository;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.example.demo.Model.Role;

@Repository
public interface RoleRepository extends JpaRepository<Role, Integer>{
	
    Optional<Role> findByAuthority(String authority);
    
}