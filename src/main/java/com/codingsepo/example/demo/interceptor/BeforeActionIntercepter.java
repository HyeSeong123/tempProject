package com.codingsepo.example.demo.interceptor;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.web.servlet.HandlerInterceptor;

import com.codingsepo.example.demo.dto.Member;
import com.codingsepo.example.demo.service.MemberService;

@Component("beforeActionInterceptor")
public class BeforeActionIntercepter implements HandlerInterceptor{
	@Autowired
	private MemberService memberService;
	
	@Override
	public boolean preHandle(HttpServletRequest request, HttpServletResponse response, Object handler)
			throws Exception {

		System.out.println("실행되나?");

		HttpSession session = request.getSession();

		// 로그인 여부에 관련된 정보를 request에 담는다.
		boolean isLogined = false;
		boolean isAdmin = false;
		int loginedMemberNum = 0;
		Member loginedMember = null;

		if (session.getAttribute("loginedMemberNum") != null) {
			loginedMemberNum = (int) session.getAttribute("loginedMemberNum");
			isLogined = true;
			loginedMember = memberService.getMemberByNum(loginedMemberNum);
			isAdmin = memberService.isAdmin(loginedMemberNum);
		}

		request.setAttribute("loginedMemberNum", loginedMemberNum);
		request.setAttribute("isLogined", isLogined);
		request.setAttribute("isAdmin", isAdmin);
		request.setAttribute("loginedMember", loginedMember);

		return HandlerInterceptor.super.preHandle(request, response, handler);
	}
}
