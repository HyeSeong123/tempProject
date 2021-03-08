package com.codingsepo.example.demo.controller;

import java.util.List;

import javax.servlet.http.HttpSession;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;

import com.codingsepo.example.demo.dto.Article;
import com.codingsepo.example.demo.dto.Reply;
import com.codingsepo.example.demo.dto.ResultData;
import com.codingsepo.example.demo.service.ArticleService;
import com.codingsepo.example.demo.service.ReplyService;
import com.codingsepo.example.demo.util.Util;

@Controller
public class UsrReplyController {
	@Autowired
	private ReplyService replyService;

	@Autowired
	private ArticleService articleService;

	@RequestMapping("/usr/reply/list")
	@ResponseBody
	public ResultData showList(String relTypeCode, Integer relNum) {

		if (relTypeCode == null) {
			return new ResultData("F-1", "관련데이터를 입력해주세요.");
		}

		if (relNum == null) {
			return new ResultData("F-2", "관련번호를 입력해주세요.");
		}

		if (relTypeCode.equals("article")) {
			Article article = articleService.getArticle(relNum);
			if (article == null) {
				return new ResultData("F-3", "존재하지 않는 게시물 입니다.");
			}

		}
		
		List<Reply> replies = replyService.getForPrintReplies(relNum,relTypeCode);
		
		return new ResultData("S-1", "성공", "replies", replies);
	}
	
	@RequestMapping("/usr/reply/doDelete")
	@ResponseBody
	public ResultData doDelete(HttpSession session, int num) {

		int loginedMemberNum = Util.getAsInt(session.getAttribute("loginedMemberNum"), 0);
		
		Reply reply = replyService.getReply(num);
		
		if(reply == null) {
			return new ResultData("F-1", "존재하지 않는 댓글 입니다.");
		}
		
		ResultData actorCanDelete = replyService.actorCanDelete(reply, loginedMemberNum);
		
		if(actorCanDelete.isFail()) {
			return actorCanDelete;
		}
		
		replyService.deleteReply(num);
		
		return new ResultData("S-1", "댓글이 삭제되었습니다.", "reply", reply);
	}
	
	@RequestMapping("/usr/reply/doModify")
	@ResponseBody
	public ResultData doModify(HttpSession session, Integer num, String body) {

		int loginedMemberNum = Util.getAsInt(session.getAttribute("loginedMemberNum"), 0);
		
		if(num == null) {
			return new ResultData("F-1", "게시물을 선택해주세요.");
		}
		
		if(body == null) {
			return new ResultData("F-2", "내용을 입력해주세요.");
		}
		
		System.out.println("num= " + num);
		Reply reply = replyService.getReply(num);
		
		if(reply == null) {
			return new ResultData("F-3", "존재하지 않는 댓글 입니다.");
		} 
		
		ResultData actorCanModify = replyService.actorCanModify(reply, loginedMemberNum);
		
		if(actorCanModify.isFail()) {
			return actorCanModify;
		}
		
		replyService.modifyRelpy(num,body);
		
		return new ResultData("S-1", "댓글이 수정되었습니다.", "reply", reply);
	}
}