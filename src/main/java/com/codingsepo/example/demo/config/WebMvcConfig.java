package com.codingsepo.example.demo.config;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.context.annotation.Configuration;
import org.springframework.web.servlet.HandlerInterceptor;
import org.springframework.web.servlet.config.annotation.CorsRegistry;
import org.springframework.web.servlet.config.annotation.InterceptorRegistry;
import org.springframework.web.servlet.config.annotation.ResourceHandlerRegistry;
import org.springframework.web.servlet.config.annotation.WebMvcConfigurer;

@Configuration
public class WebMvcConfig implements WebMvcConfigurer{
	@Value("${custom.genFileDirPath}")
	private String genFileDirPath;
	
	//CORS 허용
	@Override
	public void addCorsMappings(CorsRegistry registry) {
		registry.addMapping("/**");
	}
	
	@Autowired
	@Qualifier("beforeActionInterceptor")
	HandlerInterceptor beforeActionInterceptor;

	@Autowired
	@Qualifier("needToAdminInterceptor")
	HandlerInterceptor needToAdminInterceptor;
	
	@Autowired
	@Qualifier("needToLoginInterceptor")
	HandlerInterceptor needToLoginInterceptor;

	@Autowired
	@Qualifier("needToLogoutInterceptor")
	HandlerInterceptor needToLogoutInterceptor;
	
	// 이 함수는 인터셉터를 적용하는 역할을 합니다.
	
	@Override
	public void addInterceptors(InterceptorRegistry registry) {
		// beforeActionInterceptor 인터셉터가 모든 액션 실행전에 실행되도록 처리
		registry.addInterceptor(beforeActionInterceptor).addPathPatterns("/**").excludePathPatterns("/resource/**")
		.excludePathPatterns("/gen/**");
		
		// 어드민 필요
		registry.addInterceptor(needToAdminInterceptor)
		.addPathPatterns("/adm/**")
		.excludePathPatterns("/adm/member/login")
		.excludePathPatterns("/adm/member/doLogin");
		
		// 로그인 필요
		registry.addInterceptor(needToLoginInterceptor)
		.addPathPatterns("/**")
		.excludePathPatterns("/")		
		.excludePathPatterns("/adm/**")
		.excludePathPatterns("/gen/**")
		.excludePathPatterns("/resource/**")
		.excludePathPatterns("/usr/home/main")
		.excludePathPatterns("/usr/member/authKey")
		.excludePathPatterns("/usr/member/login")
		.excludePathPatterns("/usr/member/doLogin")
		.excludePathPatterns("/usr/member/join")
		.excludePathPatterns("/usr/member/doJoin")
		.excludePathPatterns("/usr/article/list")
		.excludePathPatterns("/usr/article/detail")
		.excludePathPatterns("/common/**")
		.excludePathPatterns("/usr/reply/list")
		.excludePathPatterns("/usr/member/findLoginId")
		.excludePathPatterns("/usr/member/doFindLoginId")
		.excludePathPatterns("/usr/member/findLoginPw")
		.excludePathPatterns("/usr/member/doFindLoginPw")
		.excludePathPatterns("/usr/file/test*")
		.excludePathPatterns("/usr/file/doTest*")
		.excludePathPatterns("/test/**")
		.excludePathPatterns("/usr/menu01/**")
		.excludePathPatterns("/usr/menu04/**")
		.excludePathPatterns("/usr/menu05/**")
		.excludePathPatterns("/error");

	// 로그인 상태에서 접속할 수 없는 URI 전부 기술
	registry.addInterceptor(needToLogoutInterceptor)
	.addPathPatterns("/adm/member/login")
    .addPathPatterns("/adm/member/doLogin")
		.addPathPatterns("/usr/member/login")
		.addPathPatterns("/usr/member/doLogin")
		.addPathPatterns("/usr/member/join")
		.addPathPatterns("/usr/member/doJoin");	
	}
	
	@Override
	public void addResourceHandlers (ResourceHandlerRegistry registry) {
		registry.addResourceHandler("/gen/**")
		.addResourceLocations("file:///" + genFileDirPath + "/").setCachePeriod(20);
	}
}
