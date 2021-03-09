package com.codingsepo.example.demo.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;

@Controller
public class UsrHomeController {
	
	@RequestMapping("/usr/home/main")
	public String showMain() {
		return "usr/home/main";
	}
	
	@RequestMapping("/usr/home/greetings")
	public String showGreetings() {
		return "usr/home/greetings";
	}
	
	@RequestMapping("/usr/home/history")
	public String showHistory() {
		return "usr/home/history";
	}
	
	@RequestMapping("/usr/home/organi")
	public String showOrgani() {
		return "usr/home/organi";
	}
	
	@RequestMapping("/usr/home/come")
	public String showCome() {
		return "usr/home/come";
	}
}
