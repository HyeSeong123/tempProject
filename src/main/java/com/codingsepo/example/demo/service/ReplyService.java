package com.codingsepo.example.demo.service;

import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.codingsepo.example.demo.dao.ReplyDao;
import com.codingsepo.example.demo.dto.Reply;
import com.codingsepo.example.demo.dto.ResultData;

@Service
public class ReplyService {
	@Autowired
	private MemberService memberService;
	
	@Autowired
	private ReplyDao replyDao;
	
	public List<Reply> getForPrintReplies(Integer relNum, String relTypeCode) {
		return replyDao.getForPrintReplies(relNum,relTypeCode);
	}

	public Reply getReply(int num) {
		return replyDao.getReply(num);
	}
	
	public ResultData actorCanModify(Reply reply, int actorNum) {

		if(reply.getMemberNum() == actorNum) {
			return new ResultData("S-1", "가능합니다.");
		}
		
		if(memberService.isAdmin(actorNum)) {
			return new ResultData("S-2", "가능합니다.");
		}
		
		return new ResultData("F-6", "권한이 없습니다.");
	}

	public ResultData actorCanDelete(Reply reply, int actorNum) {
		return actorCanModify(reply, actorNum);
	}

	public void deleteReply(int num) {
		replyDao.deleteReply(num);
	}

	public void addReply(Map<String, Object> param) {
		replyDao.addReply(param);
	}

	public void modifyRelpy(int num, String body) {
		replyDao.modifyReply(num, body);
	}

}
