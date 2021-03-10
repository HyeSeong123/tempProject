<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js"></script>

<%@ include file="../part/head.jspf"%>

	<div class="container-fluid sub_bg">
		<div class="container">	
			<h2 class="sub_tit">마이 페이지</h2>
		</div>
	</div>

	<script>
		function modifyFormSubmit(form){
			let doModifyForm_submited = false;
			
			if ( doModifyForm_submited ){
				alert('처리중 입니다.');
				return;
			}
			
			form.loginPw.value = form.loginPw.value.trim();
			
			if(form.loginPw.value.length == 0){
				alert('비밀번호를 입력해주세요.');
				form.loginPw.focus();
				return;
			}
			
			form.loginPwConfirm.value = form.loginPwConfirm.value.trim();
			
			if(form.loginPwConfirm.value.length == 0){
				alert('비밀번호 확인란을 입력해주세요.');
				form.loginPwConfirm.focus();
				return;
			}
			
			if(form.loginPw.value != form.loginPwConfirm.value){
				alert('비밀번호와 비밀번호 확인이 일치하지 않습니다.');
				form.loginPwConfirm.focus();
				return;
			}
			
			form.name.value = form.name.value.trim();
			
			if(form.name.value.length == 0){
				alert('이름을 입력해주세요.');
				form.name.focus();
				return;
			}
			
			form.nickname.value = form.nickname.value.trim();
			
			if(form.nickname.value.length == 0){
				alert('비밀번호 확인란을 입력해주세요.');
				form.nickname.focus();
				return;
			}
			
			form.email.value = form.email.value.trim();
			
			if(form.email.value.length == 0){
				alert('비밀번호 확인란을 입력해주세요.');
				form.email.focus();
				return;
			}
			
			form.loginPw.value = sha256(form.loginPw.value);
			form.loginPwConfirm.value = "";
			
			form.submit();
			doModifyForm_submited = true;
			
		}
	</script>

	<form action="doModify" method="POST" onsubmit="modifyFormSubmit(this); return false;" >
		<div>아이디: 
			<input type="text" value="${loginedMember.getLoginId()}" readonly/>						
		</div>
		
			<div>
				비밀번호 : <input type="password" name="loginPw"
					placeholder="비밀번호를 입력해주세요" />
			</div>

			<div>
				비밀번호 확인 : <input type="password" name="loginPwConfirm"
					placeholder="비밀번호를 다시 입력해주세요" />
			</div>
			
			<div>
				이름 : <input type="text" name="name" value="${loginedMember.getName()}" placeholder="이름을 입력해주세요" />
			</div>

			<div>
				닉네임 : <input type="text" name="nickname" value="${loginedMember.getNickname()}" placeholder="닉네임을 입력해주세요" />
			</div>
			
			<div>
				이메일 : <input type="email" name=email value="${loginedMember.getEmail()}" placeholder="이메일을 입력해주세요" />
			</div>
			
			<div>
				<input type="submit" value="변경"/>
			</div>
	</form>
<%@ include file="../part/foot.jspf"%>