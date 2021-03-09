<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>

<%@ include file="../part/head.jspf"%>
	
	<script>
		function findLoginFormSubmit(form){
			let doFindLoginForm_submited = false;
			
			if (doFindLoginForm_submited) {
					alert('처리중입니다.');
					return;
				}
				
			form.loginId.value = form.loginId.value.trim();
			
			if ( form.loginId.value.length == 0 ){
				alert('아이디를 입력해주세요');
				form.loginId.focus();
				return;
			}
			
			form.email.value = form.email.value.trim();
			
			if ( form.email.value.length == 0 ){
				alert('이메일을 입력해주세요');
				form.email.focus();
				return;
			}
			
			form.submit();
			doFindLoginForm_submited = true;
		}
	</script>
	<div>

		<form action="doFindLoginPw" method="POST" onsubmit="findLoginFormSubmit(this); return false;">
			
			<div>
				아이디 : <input type="text" name="loginId" placeholder="아이디를 입력해주세요" />
			</div>

			<div>
				이메일 : <input type="email" name="email" placeholder="이메일을 입력해주세요" />
			</div>

			<div>
				<input type="submit" value="아이디 찾기" />
			</div>

		</form>
	</div>
	
<%@ include file="../part/foot.jspf"%>