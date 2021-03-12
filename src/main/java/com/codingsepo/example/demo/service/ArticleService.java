package com.codingsepo.example.demo.service;

import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.codingsepo.example.demo.dao.ArticleDao;
import com.codingsepo.example.demo.dao.GenFileDao;
import com.codingsepo.example.demo.dto.Article;
import com.codingsepo.example.demo.dto.Board;
import com.codingsepo.example.demo.dto.ResultData;
import com.codingsepo.example.demo.util.Util;

@Service
public class ArticleService {

	@Autowired
	private MemberService memberService;
	
	@Autowired
	private GenFileService genFileService;
	
	@Autowired
	private GenFileDao genFileDao;
	
	@Autowired
	private ArticleDao articleDao;

	public Article getArticle(int num) {
		return articleDao.getArticle(num);
	}

	public List<Article> getArticles() {
		return articleDao.getArticles();
	}
	
	public List<Article> getForPrintArticles(int boardNum, String searchKeywordType, String searchKeyword, int page, int itemsInAPage) {
		
		int limitStart = (page -1) * itemsInAPage;
		int limitTake = itemsInAPage;
		
		return articleDao.getForPrintArticles(boardNum, searchKeywordType,searchKeyword, limitStart , limitTake);
	}
	
	public ResultData addArticle(Map<String,Object> param) {
		articleDao.addArticle(param);
		
		int num = Util.getAsInt(param.get("num"), 0);
		
		String genFileIdsStr = Util.ifEmpty((String)param.get("genFileIdsStr"), null);
		
		if ( genFileIdsStr != null) {
			List<Integer> genFileIds = Util.getListDividedBy(genFileIdsStr, ",");
			
			// 파일이 먼저 생성된 후에, 관련 데이터가 생성되는 경우에는, file의 relId가 일단 0으로 저장된다.
			// 그것을 뒤늦게라도 이렇게 고처야 한다.
			
			for (int genFileId : genFileIds) {
				genFileService.changeRelId(genFileId, num);
			}
		}
		
		genFileService.changeInputFileRelIds(param, num);
		
		return new ResultData("S-1", "성공하였습니다.", "num", num);
	}

	public ResultData deleteArticle(int num) {
		articleDao.deleteArticle(num);
		
		genFileService.deleteFiles("article",num);
		
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

	public Board getBoardByByNum(int boardNum) {
		return articleDao.getBoardByNum(boardNum);
	}

	public int totalCount(int boardNum, String searchKeyword, String searchKeywordType) {
		return articleDao.totalCount(boardNum,searchKeyword,searchKeywordType);
	}

	public void increase(int num, int view) {
		articleDao.increase(num, view);
	}
	
}
