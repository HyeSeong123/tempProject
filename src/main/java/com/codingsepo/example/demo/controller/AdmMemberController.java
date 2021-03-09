package com.codingsepo.example.demo.controller;

import java.util.Map;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import com.codingsepo.example.demo.dto.Member;
import com.codingsepo.example.demo.dto.ResultData;
import com.codingsepo.example.demo.service.MemberService;
import com.codingsepo.example.demo.util.Util;

@Controller
public class AdmMemberController {
	@Autowired
	private MemberService memberService;

	@RequestMapping("/adm/member/login")
	public String login() {
		return "adm/member/login";
	}

	
	@RequestMapping("/adm/member/doLogin")
	@ResponseBody
	public String doLogin(@RequestParam Map<String, Object> param, HttpSession session, String redirectUrl, HttpServletRequest req) {
		if (session.getAttribute("loginedMemberNum") != null) {
			return Util.msgAndBack(req,"이미 로그인 상태 입니다."); 
		};
		
		if (param.get("loginId") == null) {
			return Util.msgAndBack(req,"아이디를 입력해주세요");
		}
		
		if (param.get("loginPw") == null) {
			return Util.msgAndBack(req,"패스워드를 입력해주세요");
		}
		
		Member member = memberService.getMemberByLoginId((String) param.get("loginId"));
		
		if (member == null) {
			return Util.msgAndBack(req,String.format("%s (은)는 존재하지 않는 아이디 입니다.", param.get("loginId")));
		}
		
		if(member.getLoginPw().equals(param.get("loginPw")) == false) {
			return Util.msgAndBack(req,"패스워드가 일치하지 않습니다.");
		}
		
		if (memberService.isAdmin(member) == false) {
			return Util.msgAndBack(req,"관리자만 접근할 수 있는 페이지 입니다.");
		}
		
		session.setAttribute("loginedMemberNum", member.getNum());
		
		String msg = String.format("%s님의 로그인을 환영합니다.", member.getNickname());
		
		redirectUrl = Util.ifEmpty(redirectUrl, "../home/main");
		
		return Util.msgAndReplace(req, msg, redirectUrl);
	}
	@RequestMapping("/adm/member/doLogout")
	@ResponseBody
	public ResultData doLogout(HttpSession session) {
		session.removeAttribute("loginedMemberNum");
		
		return new ResultData("S-1", "로그아웃 되었습니다.");
	}
	
	@RequestMapping("/adm/member/doModify")
	@ResponseBody
	public ResultData doModify(@RequestParam Map<String, Object> param, HttpSession session) {
		
		int loginedMemberNum = (int)session.getAttribute("loginedMemberNum");
		
		param.put("num", loginedMemberNum);
		
		Member member = memberService.getMemberByNum(loginedMemberNum);

		if(member.getNum() != loginedMemberNum) {
			return new ResultData("F-2", "수정 권한이 없습니다.");
		}
		
		if(param.isEmpty()) {
			return new ResultData("F-3", "수정할 정보를 입력해주세요.");
		}
		
		return memberService.modifyMember(param);
	}
}
