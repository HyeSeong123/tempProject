package com.codingsepo.example.demo.controller;

import java.util.List;
import java.util.Map;

import javax.servlet.http.HttpSession;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import com.codingsepo.example.demo.dto.Article;
import com.codingsepo.example.demo.dto.ResultData;
import com.codingsepo.example.demo.service.ArticleService;
import com.codingsepo.example.demo.service.MemberService;
import com.codingsepo.example.demo.util.Util;

@Controller
public class UsrArticleController {
	@Autowired
	private MemberService memberService;
	
	@Autowired
	private ArticleService articleService;

	@RequestMapping("/usr/article/doModify")
	@ResponseBody
	public ResultData doModify(Integer num, String title, String body, HttpSession session) {
		if (num == null) {
			return new ResultData("F-2", "게시물 번호를 입력해주세요.");
		}
		int loginedMemberNum = Util.getAsInt(session.getAttribute("loginedMemberNum"),0);

		if (title == null) {
			return new ResultData("F-3", "제목을 입력해주세요.");
		}
		
		if (body == null) {
			return new ResultData("F-4", "내용을 입력해주세요.");
		}
		
		Article article = articleService.getArticle(num);
		
		if (article == null) {
			return new ResultData("F-1", String.format("%d번 게시물은 존재하지 않습니다.", num));
		}

		ResultData actorCanModify = articleService.actorCanModify(article, loginedMemberNum);
		
		if (actorCanModify.isFail()) {
			return actorCanModify;
		}
		
		return articleService.modifyArticle(num, title, body);

	}

	@RequestMapping("/usr/article/doDelete")
	@ResponseBody
	public ResultData doDelete(Integer num, HttpSession session) {
		int loginedMemberNum = Util.getAsInt(session.getAttribute("loginedMemberNum"),0);
		
		if (num == null) {
			return new ResultData("F-2", "게시물 번호를 입력해주세요.");
		}
		
		Article article = articleService.getArticle(num);
		
		if(article == null){
			return new ResultData("F-1", String.format("%d번 게시물은 존재하지 않습니다.", num));
		}
		
		ResultData actorCanDelete = articleService.actorCanDelete(article, loginedMemberNum);
		
		if (actorCanDelete.isFail()) {
			return actorCanDelete;
		}
		
		return articleService.deleteArticle(num);
	}

	@RequestMapping("/usr/article/doAdd")
	@ResponseBody
	public ResultData doAdd(@RequestParam Map<String, Object> param,HttpSession session) {
		int loginedMemberNum = Util.getAsInt(session.getAttribute("loginedMemberNum"),0);
		
		if (param.get("title") == null) {
			return new ResultData("F-2", "제목을 입력해주세요.");
		}
		
		if (param.get("body") == null) {
			return new ResultData("F-3", "내용을 입력해주세요.");
		}
		
		param.put("memberNum", loginedMemberNum);
		
		return articleService.addArticle(param);
	}

	@RequestMapping("/usr/article/detail")
	@ResponseBody
	public ResultData showDetail(Integer num) {
		if(num == null) {
			return new ResultData("F-1", "게시물 번호를입력해주세요.");
		}
		
		Article article = articleService.getForPrintArticle(num);
		
		if(article == null) {
			return new ResultData("F-2", "존재하지 않는 게시물 번호입니다.");
		}
		
		return new ResultData("S-1", "성공", "article", article) ;
	}

	@RequestMapping("/usr/article/list")
	@ResponseBody
	public ResultData showList(@RequestParam(defaultValue = "titleAndBody") String searchKeywordType, String searchKeyword) {
		if (searchKeywordType != null) {
			searchKeywordType = searchKeywordType.trim();
		}
		
		if(searchKeyword != null && searchKeyword.length() == 0) {
			searchKeyword = null;
		}
		
		if ( searchKeyword != null) {
			searchKeyword = searchKeyword.trim();
		}
		
		if(searchKeyword == null) {
			searchKeywordType = null;
		}
		
		List<Article> articles = articleService.getForPrintArticles(searchKeywordType, searchKeyword);
		
		return new ResultData("S-1", "성공", "articles", articles);
	}

}
