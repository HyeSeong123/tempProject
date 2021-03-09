package com.codingsepo.example.demo.service;

import java.util.HashMap;
import java.util.Map;
import java.util.Random;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Service;

import com.codingsepo.example.demo.dao.MemberDao;
import com.codingsepo.example.demo.dto.Member;
import com.codingsepo.example.demo.dto.ResultData;
import com.codingsepo.example.demo.util.Util;

@Service
public class MemberService {
	@Autowired
	private MemberDao memberDao;

	@Autowired
	private MailService mailService;
	
	@Value("${custom.siteName}")
	private String siteName;

	@Value("${custom.siteUri}")
	private String siteUrl;
	
	@Value("${custom.siteLoginUri}")
	private String siteLoginUri;
	
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

	public Member getMemberByNameAndEmail(String name, String email) {
		return memberDao.getMemberByNameAndEmail(name,email);
	}

	public ResultData setTempPasswordAndNotify(Member member) {
		Random r = new Random();
		String tempLoginPw = (10000 + r.nextInt(90000)) + "";

		String mailTitle = String.format("[%s] 임시 패스워드가 발송 되었습니다.", siteName);
		String mailBody = "";

		mailBody += String.format("로그인 아이디 : %s<br>", member.getLoginId());
		mailBody += String.format("임시 비밀번호 : %s", tempLoginPw);
		mailBody += "<br>";
		mailBody += String.format("<a href=\"%s\" target=\"_blank\">로그인 하러가기</a>", siteLoginUri);

		ResultData sendResultData = mailService.send(member.getEmail(), mailTitle, mailBody);

		if (sendResultData.isFail()) {
			return new ResultData("F-1", "메일발송에 실패했습니다.");
		}

		Map<String, Object> modifyParam = new HashMap<>();

		modifyParam.put("loginPw", Util.sha256(tempLoginPw));
		modifyParam.put("loginId", member.getLoginId());
		modifyParam.put("num", member.getNum());

		memberDao.doModify(modifyParam);

		return new ResultData("S-1", "임시 패스워드를 메일로 발송하였습니다.");
	}
}
