package com.codingsepo.example.demo.interceptor;

import java.util.Map;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.web.servlet.HandlerInterceptor;

import com.codingsepo.example.demo.dto.Member;
import com.codingsepo.example.demo.service.MemberService;
import com.codingsepo.example.demo.util.Util;

@Component("beforeActionInterceptor")
public class BeforeActionIntercepter implements HandlerInterceptor {
	@Autowired
	private MemberService memberService;

	@Override
	public boolean preHandle(HttpServletRequest request, HttpServletResponse response, Object handler)
			throws Exception {
		
		Map<String, Object> param = Util.getParamMap(request);
		String paramJson = Util.toJsonStr(param);

		String requestUrl = request.getRequestURI();
		String queryString = request.getQueryString();

		if (queryString != null && queryString.length() > 0) {
			requestUrl += "?" + queryString;
		}

		String encodedRequestUrl = Util.getUrlEncoded(requestUrl);

		request.setAttribute("requestUrl", requestUrl);
		request.setAttribute("encodedRequestUrl", encodedRequestUrl);

		request.setAttribute("afterLoginUrl", requestUrl);
		request.setAttribute("encodedAfterLoginUrl", encodedRequestUrl);

		request.setAttribute("paramMap", param);
		request.setAttribute("paramJson", paramJson);
		
		int loginedMemberNum = 0;
		Member loginedMember = null;

		String authKey = request.getParameter("authKey");
		
		if (authKey != null && authKey.length() > 0) {
			loginedMember = memberService.getMemberByAuthKey(authKey);

			if (loginedMember == null) {
				request.setAttribute("authKeyStatus", "invalid");
			} else {
				request.setAttribute("authKeyStatus", "valid");
				loginedMemberNum = loginedMember.getNum();

			}
		} else {
			HttpSession session = request.getSession();
			request.setAttribute("authKeyStatus", "none");

			if (session.getAttribute("loginedMemberNum") != null) {
				loginedMemberNum = (int) session.getAttribute("loginedMemberNum");
				loginedMember = memberService.getMemberByNum(loginedMemberNum);
			}
		}
		// 로그인 여부에 관련된 정보를 request에 담는다.
		boolean isLogined = false;
		boolean isAdmin = false;

		if (loginedMember != null) {
			isLogined = true;
			isAdmin = memberService.isAdmin(loginedMemberNum);
		}

		request.setAttribute("loginedMemberNum", loginedMemberNum);
		request.setAttribute("isLogined", isLogined);
		request.setAttribute("isAdmin", isAdmin);
		request.setAttribute("loginedMember", loginedMember);

		return HandlerInterceptor.super.preHandle(request, response, handler);
	}
}
