package com.codingsepo.example.demo.controller;

import java.util.Map;

import javax.servlet.http.HttpSession;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import com.codingsepo.example.demo.dto.Member;
import com.codingsepo.example.demo.dto.ResultData;
import com.codingsepo.example.demo.service.MemberService;

@Controller
public class UsrMemberController {
	@Autowired
	private MemberService memberService;

	@RequestMapping("/usr/member/doJoin")
	@ResponseBody
	public ResultData doModify(@RequestParam Map<String, Object> param) {

		Member existingMember = memberService.getMemberByLoginId((String) param.get("loginId"));

		if (existingMember != null) {
			return new ResultData("F-2", String.format("%s (은)는 이미 사용중인 로그인아이디 입니다.", param.get("loginId")));
		}

		if (param.get("loginId") == null) {
			return new ResultData("F-1", "아이디를 입력해주세요");
		}

		if (param.get("loginPw") == null) {
			return new ResultData("F-1", "아이디를 입력해주세요");
		}

		if (param.get("email") == null) {
			return new ResultData("F-1", "아이디를 입력해주세요");
		}

		if (param.get("hpNum") == null) {
			return new ResultData("F-1", "아이디를 입력해주세요");
		}

		if (param.get("nickname") == null) {
			return new ResultData("F-1", "아이디를 입력해주세요");
		}

		if (param.get("name") == null) {
			return new ResultData("F-1", "아이디를 입력해주세요");
		}
		return memberService.join(param);
	}

	@RequestMapping("/usr/member/doLogin")
	@ResponseBody
	public ResultData doLogin(@RequestParam Map<String, Object> param, HttpSession session) {
		if (session.getAttribute("loginedMemberNum") != null) {
			return new ResultData("F-4", "이미 로그인 상태 입니다.");
		}
		;

		if (param.get("loginId") == null) {
			return new ResultData("F-1", "아이디를 입력해주세요");
		}

		if (param.get("loginPw") == null) {
			return new ResultData("F-2", "패스워드를 입력해주세요");
		}

		Member member = memberService.getMemberByLoginId((String) param.get("loginId"));

		if (member == null) {
			return new ResultData("F-2", String.format("%s (은)는 존재하지 않는 아이디 입니다.", param.get("loginId")));
		}

		if (member.getLoginPw().equals(param.get("loginPw")) == false) {
			return new ResultData("F-3", "패스워드가 일치하지 않습니다.");
		}

		session.setAttribute("loginedMemberNum", member.getNum());

		return new ResultData("S-1", String.format("%s님의 로그인을 환영합니다.", member.getNickname()));
	}

	@RequestMapping("/usr/member/authKey")
	@ResponseBody
	public ResultData showAuthkey(String loginId, String loginPw) {
		if (loginId == null) {
			return new ResultData("F-1", "아이디를 입력해주세요");
		}

		Member existingMember = memberService.getMemberByLoginId(loginId);

		if (existingMember == null) {
			return new ResultData("F-2", "존재하지 않는 아이디입니다.", "loginId", loginId);
		}

		if(loginPw == null) {
			return new ResultData("F-1", "loginPw를 입력해주세요");
		}
		
		if(existingMember.getLoginPw().equals(loginPw) == false) {
			return new ResultData("F-3", "비밀번호가 일치하지 않습니다.");
		}
		
		return new ResultData("S-1", String.format("%s님의 로그인을 환영합니다.", existingMember.getNickname()), "authKey",existingMember.getAuthKey());
	}
	
	@RequestMapping("/usr/member/memberByAuthKey")
	@ResponseBody
	public ResultData showMemberByAuthkey(String authKey) {
		if (authKey == null) {
			return new ResultData("F-1", "authKey를 입력하세요");
		}

		Member existingMember = memberService.getMemberByAuthKey(authKey);
		
		return new ResultData("S-1", String.format("유효한 회원입니다."), "member", existingMember);
	}
	
	@RequestMapping("/usr/member/doLogout")
	@ResponseBody
	public ResultData doLogout(HttpSession session) {
		session.removeAttribute("loginedMemberNum");

		return new ResultData("S-1", "로그아웃 되었습니다.");
	}

	@RequestMapping("/usr/member/doModify")
	@ResponseBody
	public ResultData doModify(@RequestParam Map<String, Object> param, HttpSession session) {

		int loginedMemberNum = (int) session.getAttribute("loginedMemberNum");

		param.put("num", loginedMemberNum);

		Member member = memberService.getMemberByNum(loginedMemberNum);

		if (member.getNum() != loginedMemberNum) {
			return new ResultData("F-2", "수정 권한이 없습니다.");
		}

		if (param.isEmpty()) {
			return new ResultData("F-3", "수정할 정보를 입력해주세요.");
		}

		return memberService.modifyMember(param);
	}
}
