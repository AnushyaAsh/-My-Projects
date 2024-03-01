package com.example.demo.Service;

import com.example.demo.Model.User;
import com.example.demo.dto.UserDto;

public interface UserService {
	
	User save(UserDto userDto);

}
