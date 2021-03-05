package com.codingsepo.example.demo.controller;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;

import com.codingsepo.example.demo.dto.Article;
import com.codingsepo.example.demo.dto.ResultData;
import com.codingsepo.example.demo.service.ArticleService;
import com.codingsepo.example.demo.util.Util;

@Controller
public class UsrArticleController {
	@Autowired
	private ArticleService articleService;

	@RequestMapping("/usr/article/doModify")
	@ResponseBody
	public ResultData doModify(int num, String title, String body) {

		String updateDate = Util.getNowDataStr();
		
		boolean selArticle = articleService.doModify(num,updateDate,title,body);
		
		if (selArticle == false) {
			return new ResultData("F-1", String.format("%d번 게시물은 존재하지 않습니다.", num));
		}

		return new ResultData("S-1", String.format("%d번 게시물 수정에 성공하였습니다.", num));

	}

	@RequestMapping("/usr/article/doDelete")
	@ResponseBody
	public ResultData doDelete(int num) {
		boolean deleteArticleRs = articleService.deleteArticle(num);

		Map<String, Object> rs = new HashMap<>();

		if (deleteArticleRs == false) {
			return new ResultData("F-1", "해당 게시물은 존재하지 않습니다.");
		}

		return new ResultData("S-1" , "성공하였습니다.", "num", num);
	}

	@RequestMapping("/usr/article/doAdd")
	@ResponseBody
	public ResultData doAdd(String title, String body) {

		String regDate = Util.getNowDataStr();
		String updateDate = Util.getNowDataStr();

		int articlesLastNum = articleService.doAdd(regDate,updateDate,title,body);

		return new ResultData("S-1", "성공하였습니다.", "num", articlesLastNum);
	}

	@RequestMapping("/usr/article/detail")
	@ResponseBody
	public Article showDetail(int num) {
		Article article = articleService.getArticle(num);
		
		return article;
	}

	@RequestMapping("/usr/article/list")
	@ResponseBody
	public List<Article> showList() {

		List<Article> articles = articleService.getArticles();
		
		return articles;
	}

}
