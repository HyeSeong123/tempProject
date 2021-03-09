<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js"></script>
<%@ include file="../part/head.jspf"%>

	<div class="container-fluid sub_bg">
		<div class="container">
			<h2 class="sub_tit">로그인</h2>
		</div>
	</div>
	<div class="login">
	
		<script>
		function loginFormSubmit(form){
			let doLoginForm_submited = false;
			
			if (doLoginForm_submited) {
					alert('처리중입니다.');
					return;
				}
				
			form.loginId.value = form.loginId.value.trim();
			
			if ( form.loginId.value.length == 0 ){
				alert('로그인 아이디를 입력해주세요');
				form.loginId.focus();
				return;
			}
			
			form.loginPw.value = form.loginPw.value.trim();
			
			if ( form.loginPw.value.length == 0 ){
				alert('로그인 패스워드를 입력해주세요');
				form.loginPw.focus();
				return;
			}
			
			form.loginPw.value = sha256(form.loginPw.value);
			
			form.submit();
			doLoginForm_submited = true;
		}
	</script>
	
		<form method="post" action="#" class="login-form" onsubmit="loginFormSubmit(this); return false;">
			<fieldset>
				<div class="username">
					<label for="user_login">아이디 </label> <input type="text" name="log"
						value="" size="20" id="user_login" tabindex="105">
				</div>
				<div class="password">
					<label for="user_pass">비밀번호 </label> <input type="password"
						name="pwd" value="" size="20" id="user_pass" tabindex="106">
				</div>
				<div class="remember-me">
					<input type="checkbox" name="rememberme" value="forever"
						id="rememberme" tabindex="107"> <label for="rememberme">아이디
						저장</label>
				</div>
				<div class="submit-wrapper">
					<button type="submit" name="user-submit" id="user-submit"
						tabindex="108" class="button submit user-submit">로그인</button>
				</div>
			</fieldset>
		</form>
		<div class="link">
			<a href="#">아이디</a> <a href="#">비밀번호찾기</a>
		</div>
		<div class="btn_group signup">
			<a href="#this" class="btn btn_gold">회원가입</a>
		</div>

	</div>

	<div class="site-search" id="search-box">
		<button class="close-btn js-close-search">
			<i class="fa fa-times" aria-hidden="true"></i>
		</button>
		<div class="form-container">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<form role="search" method="get" class="search-form"
							action="http://ahetopro/" autocomplete="off">
							<div class="input-group">
								<input type="search" value="" name="s" class="search-field"
									placeholder="Enter Keyword" required="">
							</div>
						</form>
						<p class="search-description">Input your search keywords and
							press Enter.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Magnific popup -->
	<script src="/resource/js/jquery.magnific-popup.min.js"></script>
	<!-- anm -->
	<script src="../js/anm.min.js"></script>
	<!-- Google maps -->
	<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARwCmK-LlGIH8Mv1ac4VyceMYUgg9vStM&amp;#038;&language=en"></script>
	<script src="/resource/js/google-maps.js?v=1"></script>
	<!-- FullCalendar -->
	<!-- Parallax -->
	<script src="/resource/js/parallax.min.js"></script>
	<!-- asRange -->
	<script src="/resource/js/jquery.range-min.js"></script>
	<!-- lightgallery -->
	<script src="/resource/js/lightgallery.min.js"></script>
	<!-- Main script -->
	<script src="/resource/js/script.js?v=1"></script>
	<script src="/resource/js/spectragram.min.js"></script>
	<script>
        $(document).ready(function() {
            jQuery.fn.spectragram.accessData = {
                accessToken: '4058508404.1677ed0.f87c0182df0d4512a9e01def0c53adb7'
            }

            $('.instafeed').spectragram('getUserFeed', {
                size: 'big',
                max: 6
            });
        });

    </script>
</body>

<%@ include file="../part/foot.jspf"%>