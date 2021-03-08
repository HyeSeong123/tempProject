package com.codingsepo.example.demo.service;

import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.codingsepo.example.demo.dao.MemberDao;
import com.codingsepo.example.demo.dto.Member;
import com.codingsepo.example.demo.dto.ResultData;
import com.codingsepo.example.demo.util.Util;

@Service
public class MemberService {
	@Autowired
	private MemberDao memberDao;

	public ResultData join(Map<String, Object> param) {
		memberDao.join(param);

		int num = Util.getAsInt(param.get("num"), 0);

		return new ResultData("S-1", String.format("%s님의 회원가입을 환영합니다.", param.get("nickname")), "num", num);
	}

	public Member getMemberByLoginId(String loginId) {
		return memberDao.getMemberByLoginId(loginId);
	}

	public Member getMemberByNum(int loginedMemberNum) {
		return memberDao.getMemberByNum(loginedMemberNum);
	}

	public ResultData modifyMember(Map<String, Object> param) {
		memberDao.modifyMember(param);
		
		return new ResultData("S-1", "회원정보가 수정되었습니다.");
	}

	public boolean isAdmin(int actorNum) {
		return actorNum == 1;
	}

	public boolean isAdmin(Member actor) {
		return isAdmin(actor.getNum());
	}

	public Member getMemberByAuthKey(String authKey) {
		return memberDao.getMemberByAuthkey(authKey);
	}
}
