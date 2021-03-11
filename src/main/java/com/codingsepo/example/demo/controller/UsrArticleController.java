package com.codingsepo.example.demo.controller;

import java.util.List;
import java.util.Map;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.multipart.MultipartFile;
import org.springframework.web.multipart.MultipartRequest;

import com.codingsepo.example.demo.dto.Article;
import com.codingsepo.example.demo.dto.Board;
import com.codingsepo.example.demo.dto.GenFile;
import com.codingsepo.example.demo.dto.Member;
import com.codingsepo.example.demo.dto.ResultData;
import com.codingsepo.example.demo.service.ArticleService;
import com.codingsepo.example.demo.service.GenFileService;
import com.codingsepo.example.demo.service.ReplyService;
import com.codingsepo.example.demo.util.Util;

@Controller
public class UsrArticleController {

	@Autowired
	private ArticleService articleService;

	@Autowired
	private ReplyService replyService;

	@Autowired
	private GenFileService genFileService;

	@RequestMapping("/usr/article/doModify")
	@ResponseBody
	public ResultData doModify(Integer num, String title, String body, HttpSession session) {
		if (num == null) {
			return new ResultData("F-2", "게시물 번호를 입력해주세요.");
		}
		int loginedMemberNum = Util.getAsInt(session.getAttribute("loginedMemberNum"), 0);

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
		int loginedMemberNum = Util.getAsInt(session.getAttribute("loginedMemberNum"), 0);

		if (num == null) {
			return new ResultData("F-2", "게시물 번호를 입력해주세요.");
		}

		Article article = articleService.getArticle(num);

		if (article == null) {
			return new ResultData("F-1", String.format("%d번 게시물은 존재하지 않습니다.", num));
		}

		ResultData actorCanDelete = articleService.actorCanDelete(article, loginedMemberNum);

		if (actorCanDelete.isFail()) {
			return actorCanDelete;
		}

		return articleService.deleteArticle(num);
	}

	@RequestMapping("/usr/article/add")
	public String showAdd() {

		return "usr/article/add";
	}

	/*
	 * @RequestMapping("/usr/article/doAdd") public String doAdd(@RequestParam
	 * Map<String, Object> param, HttpSession session, HttpServletRequest req,
	 * MultipartRequest multipartRequest) { Map<String, MultipartFile> fileMap =
	 * multipartRequest.getFileMap();
	 * 
	 * int loginedMemberNum =
	 * Util.getAsInt(session.getAttribute("loginedMemberNum"), 0);
	 * 
	 * if (param.get("title") == null) { return Util.msgAndBack(req, "제목을 입력해주세요.");
	 * }
	 * 
	 * if (param.get("body") == null) { return Util.msgAndBack(req, "내용을 입력해주세요.");
	 * }
	 * 
	 * param.put("memberNum", loginedMemberNum);
	 * 
	 * articleService.addArticle(param);
	 * 
	 * return Util.msgAndReplace(req, "작성이 완료되었습니다.", "/usr/article/list?boardNum="
	 * + param.get("boardNum")); }
	 */
	@RequestMapping("/usr/article/doAddTest")
	public String doAddTest(@RequestParam Map<String, Object> param, HttpSession session, HttpServletRequest req,
			MultipartRequest multipartRequest) {
		int loginedMemberNum = Util.getAsInt(session.getAttribute("loginedMemberNum"), 0);

		if (param.get("title") == null) {
			return Util.msgAndBack(req, "제목을 입력해주세요.");
		}

		if (param.get("body") == null) {
			return Util.msgAndBack(req, "내용을 입력해주세요.");
		}

		param.put("memberNum", loginedMemberNum);

		ResultData addArticleRd = articleService.addArticle(param);

		System.out.println("addParam=" + param);
		System.out.println("addArticleRd=" + addArticleRd);

		int newArticleNum = (int) addArticleRd.getBody().get("num");

		Map<String, MultipartFile> fileMap = multipartRequest.getFileMap();

		for (String fileInputName : fileMap.keySet()) {
			MultipartFile multipartFile = fileMap.get(fileInputName);

			if (multipartFile.isEmpty() == false) {
				genFileService.save(multipartFile, newArticleNum);
			}
		}

		return Util.msgAndReplace(req, "작성이 완료되었습니다.", "/usr/article/list?boardNum=" + param.get("boardNum"));
	}

	@RequestMapping("/usr/article/detail")
	public String showDetail(Integer num, HttpServletRequest req, Model model, String redirectUrl) {
		if (num == null) {
			return Util.msgAndBack(req, "게시물 번호를 입력해주세요.");
		}

		Article article = articleService.getForPrintArticle(num);

		if (article == null) {
			return Util.msgAndBack(req, "존재하지 않는 게시물 번호입니다.");
		}

		if (redirectUrl == null) {
			redirectUrl = "/usr/article/list?boardNum=" + article.getBoardNum();
		}

		Board board = articleService.getBoardByByNum(article.getBoardNum());

		articleService.increase(num, article.getView());

		model.addAttribute("board", board);
		model.addAttribute("redirectUrl", redirectUrl);
		model.addAttribute("article", article);

		return "usr/article/detail";
	}

	@RequestMapping("/usr/article/list")
	public String showList(@RequestParam(defaultValue = "1") int page, @RequestParam(defaultValue = "1") int boardNum,
			HttpServletRequest req, Model model, @RequestParam(defaultValue = "titleAndBody") String searchKeywordType,
			String searchKeyword) {

		Board board = articleService.getBoardByByNum(boardNum);

		if (board == null) {
			return Util.msgAndBack(req, "존재하지 않는 게시판 입니다.");
		}

		if (searchKeywordType != null) {
			searchKeywordType = searchKeywordType.trim();
		}

		if (searchKeyword != null && searchKeyword.length() == 0) {
			searchKeyword = null;
		}

		if (searchKeyword != null) {
			searchKeyword = searchKeyword.trim();
		}

		if (searchKeyword == null) {
			searchKeywordType = null;
		}

		int totalCount = articleService.totalCount(boardNum, searchKeyword, searchKeywordType);

		int itemsCountInAPage = 10;
		int totalPage = (int) Math.ceil(totalCount / (double) itemsCountInAPage);
		int pageMenuArmSize = 4;
		int pageMenuStart = page - pageMenuArmSize;

		if (pageMenuStart < 1) {
			pageMenuStart = 1;
		}
		int pageMenuEnd = page + pageMenuArmSize;

		if (pageMenuEnd > totalPage) {
			pageMenuEnd = totalPage;
		}

		Member loginedMember = (Member) req.getAttribute("loginedMember");
		List<Article> articles = articleService.getForPrintArticles(boardNum, searchKeywordType, searchKeyword, page,
				itemsCountInAPage);

		if (boardNum == 2) {
			for (Article article : articles) {
				GenFile genFile = genFileService.getGenFile("article", article.getNum(), "common", "attachment", 1);

				if (genFile != null) {
					article.setExtra__thumbImg(genFile.getForPrintUrl());
				}
			}
		}

		req.setAttribute("board", board);
		model.addAttribute("totalCount", totalCount);
		model.addAttribute("page", page);
		model.addAttribute("pageMenuStart", pageMenuStart);
		model.addAttribute("pageMenuEnd", pageMenuEnd);
		req.setAttribute("articles", articles);

		return "usr/article/list";
	}

	@RequestMapping("/usr/article/doAddReply")
	@ResponseBody
	public ResultData doAddReply(HttpSession session, @RequestParam Map<String, Object> param) {

		int loginedMemberNum = Util.getAsInt(session.getAttribute("loginedMemberNum"), 0);

		if (param.get("body") == null) {
			return new ResultData("F-1", "댓글의 내용을 입력해주세요");
		}

		if (param.get("relTypeCode") == null) {
			return new ResultData("F-2", "관련 코드를 입력해주세요");
		}

		if (param.get("relNum") == null) {
			return new ResultData("F-3", "관련 번호를 입력해주세요");
		}

		param.put("memberNum", loginedMemberNum);

		replyService.addReply(param);

		return new ResultData("S-1", "댓글이 작성되었습니다.");
	}
}
