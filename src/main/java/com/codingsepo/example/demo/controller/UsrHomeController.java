package com.codingsepo.example.demo.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.codingsepo.example.demo.dto.Article;
import com.codingsepo.example.demo.service.ArticleService;

@Controller
public class UsrHomeController {
	@Autowired
	ArticleService articleService;
	
	@RequestMapping("/usr/home/main")
	public String showMain(Model model) {
		
		List<Article> articles = articleService.getArticles();
		
		model.addAttribute("articles", articles);
		
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
