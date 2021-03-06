package com.codingsepo.example.demo.controller;

import java.util.List;

import javax.servlet.http.HttpServletRequest;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;

import com.codingsepo.example.demo.dto.Article;
import com.codingsepo.example.demo.dto.Board;
import com.codingsepo.example.demo.dto.ResultData;
import com.codingsepo.example.demo.service.ArticleService;
import com.codingsepo.example.demo.util.Util;

@Controller
public class UsrMenuController {
	
	@Autowired
	private ArticleService articleService;
	
	/* 대전예총 메뉴 시작 */
	
	@RequestMapping("/usr/menu01/greetings")
	public String showGreetings() {
		return "usr/menu01/greetings";
	}
	
	@RequestMapping("/usr/menu01/history")
	public String showHistory() {
		return "usr/menu01/history";
	}
	
	@RequestMapping("/usr/menu01/organi")
	public String showOrgani() {
		return "usr/menu01/organi";
	}
	
	@RequestMapping("/usr/menu01/come")
	public String showCome() {
		return "usr/menu01/come";
	}
	
	/* 대전예총 메뉴 끝 */
	
	/* 회원단체 메뉴 시작 */
	
	@RequestMapping("/usr/menu04/construct")
	public String showConstruct() {
		return "usr/menu04/construct";
	}
	
	@RequestMapping("/usr/menu04/tradMusic")
	public String showTradMusic() {
		return "usr/menu01/tradMusic";
	}
	
	@RequestMapping("/usr/menu04/dancing")
	public String showDancing() {
		return "usr/menu01/dancing";
	}
	
	@RequestMapping("/usr/menu04/writer")
	public String showWriter() {
		return "usr/menu01/writer";
	}
	
	@RequestMapping("/usr/menu04/art")
	public String showArt() {
		return "usr/menu01/art";
	}
	
	@RequestMapping("/usr/menu04/photo")
	public String showPhoto() {
		return "usr/menu01/photo";
	}
	
	@RequestMapping("/usr/menu04/theater")
	public String showTheater() {
		return "usr/menu01/theater";
	}
	
	@RequestMapping("/usr/menu04/enter")
	public String showEnter() {
		return "usr/menu01/enter";
	}
	
	@RequestMapping("/usr/menu04/movie")
	public String showMovie() {
		return "usr/menu01/movie";
	}
	
	@RequestMapping("/usr/menu04/music")
	public String showMusic() {
		return "usr/menu01/music";
	}
	/* 회원단체 메뉴 끝 */
	
	/* 협회소식 메뉴 시작 */

}
