package com.codingsepo.example.demo.service;

import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.codingsepo.example.demo.dao.ArticleDao;
import com.codingsepo.example.demo.dto.Article;
import com.codingsepo.example.demo.dto.ResultData;
import com.codingsepo.example.demo.util.Util;

@Service
public class ArticleService {

	@Autowired
	private MemberService memberService;
	
	@Autowired
	private ArticleDao articleDao;

	public Article getArticle(int num) {
		return articleDao.getArticle(num);
	}

	public List<Article> getArticles(String searchKeywordType, String searchKeyword) {
		return articleDao.getArticles(searchKeywordType, searchKeyword);
	}
	
	public List<Article> getForPrintArticles(String searchKeywordType, String searchKeyword) {
		return articleDao.getForPrintArticles(searchKeywordType,searchKeyword);
	}
	
	public ResultData addArticle(Map<String,Object> param) {
		int num = Util.getAsInt(param.get("num"), 0);
		
		articleDao.addArticle(param);

		return new ResultData("S-1", "성공하였습니다.", "num", num);
	}

	public ResultData deleteArticle(int num) {
		articleDao.deleteArticle(num);
		
		return new ResultData("S-1", "삭제하였습니다.", "num", num);
	}

	public ResultData modifyArticle(int num, String title, String body) {

		articleDao.modifyArticle(num, title, body);

		return new ResultData("S-1", "게시물을 수정하였습니다.", "num", num);
	}

	public ResultData actorCanModify(Article article, int actorNum) {

		if(article.getMemberNum() == actorNum) {
			return new ResultData("S-1", "가능합니다.");
		}
		
		if(memberService.isAdmin(actorNum)) {
			return new ResultData("S-2", "가능합니다.");
		}
		
		return new ResultData("F-6", "권한이 없습니다.");
	}

	public ResultData actorCanDelete(Article article, int actorNum) {
		return actorCanModify(article, actorNum);
	}

	public Article getForPrintArticle(int num) {
		return articleDao.getForPrintArticle(num);
	}

}
