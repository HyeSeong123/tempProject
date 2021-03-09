package com.codingsepo.example.demo.controller;

import java.net.http.HttpRequest;
import java.util.Map;

import javax.servlet.http.HttpServlet;
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
public class UsrMemberController {
	@Autowired
	private MemberService memberService;

	@RequestMapping("/usr/member/join")
	public String showJoin(@RequestParam Map<String, Object> param) {

		return "usr/member/join";
	}

	@RequestMapping("/usr/member/doJoin")
	public String doJoin(@RequestParam Map<String, Object> param, HttpServletRequest req) {

		Member existingMember = memberService.getMemberByLoginId((String) param.get("loginId"));

		if (existingMember != null) {
			return Util.msgAndBack(req, param.get("loginId") + "(은)는 이미 사용중인 아이디 입니다.");
		}

		if (param.get("loginId") == null) {
			return Util.msgAndBack(req, "아이디를 입력해주세요");
		}

		if (param.get("loginPw") == null) {
			return Util.msgAndBack(req, "아이디를 입력해주세요");
		}

		if (param.get("email") == null) {
			return Util.msgAndBack(req, "아이디를 입력해주세요");
		}

		if (param.get("hpNum") == null) {
			return Util.msgAndBack(req, "아이디를 입력해주세요");
		}

		if (param.get("nickname") == null) {
			return Util.msgAndBack(req, "아이디를 입력해주세요");
		}

		if (param.get("name") == null) {
			return Util.msgAndBack(req, "아이디를 입력해주세요");
		}
		memberService.join(param);

		String msg = String.format("%s님의 회원가입을 환영합니다.", param.get("nickname"));

		String redirectUrl = (String) param.get("redirectUrl");

		redirectUrl = Util.ifEmpty(redirectUrl, "../member/login");

		return Util.msgAndReplace(req, msg, redirectUrl);
	}

	@RequestMapping("/usr/member/login")
	public String showLogin() {

		return "usr/member/login";
	}

	@RequestMapping("/usr/member/doLogin")
	public String doLogin(@RequestParam Map<String, Object> param, HttpSession session, HttpServletRequest req) {
		if (param.get("loginId") == null) {
			return Util.msgAndBack(req, "아이디를 입력해주세요");
		}

		if (param.get("loginPw") == null) {
			return Util.msgAndBack(req, "패스워드를 입력해주세요");
		}

		Member member = memberService.getMemberByLoginId((String) param.get("loginId"));

		if (member == null) {
			return Util.msgAndBack(req, param.get("loginId") + ") + (은)는 존재하지 않는 아이디 입니다.");
		}

		if (member.getLoginPw().equals(param.get("loginPw")) == false) {
			return Util.msgAndBack(req, "패스워드가 일치하지 않습니다.");
		}

		session.setAttribute("loginedMemberNum", member.getNum());

		String msg = String.format("%s님의 로그인을 환영합니다.", member.getNickname());

		String redirectUrl = (String) param.get("redirectUrl");

		redirectUrl = Util.ifEmpty(redirectUrl, "../home/main");

		return Util.msgAndReplace(req, msg, redirectUrl);
	}

	@RequestMapping("/usr/member/findLoginId")
	public String showFindLoginId() {

		return "usr/member/findLoginId";

	}

	@RequestMapping("/usr/member/doFindLoginId")
	public String doFindLoginId(@RequestParam Map<String, Object> param, HttpSession session, HttpServletRequest req) {
		if (param.get("name") == null) {
			return Util.msgAndBack(req, "이름을 입력해주세요");
		}

		if (param.get("email") == null) {
			return Util.msgAndBack(req, "이메일을 입력해주세요");
		}

		String name = (String) param.get("name");
		String email = (String) param.get("email");

		Member member = memberService.getMemberByNameAndEmail(name, email);

		if (member == null) {
			return Util.msgAndBack(req, "일치하는 회원 정보가 없습니다.");
		}

		String msg = String.format("회원님의 아이디는" + member.getLoginId() + "입니다.");

		String redirectUrl = (String) param.get("redirectUrl");

		redirectUrl = Util.ifEmpty(redirectUrl, "../member/login");

		return Util.msgAndReplace(req, msg, redirectUrl);
	}

	@RequestMapping("/usr/member/findLoginPw")
	public String showFindLoginPw() {

		return "usr/member/findLoginPw";

	}

	@RequestMapping("/usr/member/doFindLoginPw")
	public String doFindLoginPw(@RequestParam Map<String, Object> param, HttpSession session, HttpServletRequest req) {
	
		if (param.get("loginId") == null) {
			return Util.msgAndBack(req, "아이디를 입력해주세요");
		}

		if (param.get("email") == null) {
			return Util.msgAndBack(req, "이메일을 입력해주세요");
		}

		String loginId = (String) param.get("loginId");
		String email = (String) param.get("email");

		Member member = memberService.getMemberByLoginId(loginId);

		if (member == null) {
			return Util.msgAndBack(req, "일치하는 아이디가 없습니다.");
		}

		if(member.getEmail().equals(email) == false) {
			return Util.msgAndBack(req, "아이디와 이메일이 일치하지 않습니다.");
		}
		
		String msg = String.format("회원님의 임시비밀번호가" + member.getEmail() + "로 전송되었습니다.");
		
		String redirectUrl = (String) param.get("redirectUrl");

		redirectUrl = Util.ifEmpty(redirectUrl, "../member/login");

		ResultData setTempPasswordAndNotifyRsData = memberService.setTempPasswordAndNotify(member);
		
		return Util.msgAndReplace(req, msg, redirectUrl);
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

		if (loginPw == null) {
			return new ResultData("F-1", "loginPw를 입력해주세요");
		}

		if (existingMember.getLoginPw().equals(loginPw) == false) {
			return new ResultData("F-3", "비밀번호가 일치하지 않습니다.");
		}

		return new ResultData("S-1", String.format("%s님의 로그인을 환영합니다.", existingMember.getNickname()), "authKey",
				existingMember.getAuthKey());
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
	public String doLogout(HttpSession session, HttpServletRequest req) {
		session.removeAttribute("loginedMemberNum");

		return Util.msgAndReplace(req, "로그아웃 되었습니다.", "../home/main");
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
