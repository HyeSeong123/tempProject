<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<!DOCTYPE html>
<html>

<%@ include file="../part/head.jspf"%>

	<div class="container-fluid sub_bg">
		<div class="container">
			<h2 class="sub_tit">인사말</h2>
		</div>
	</div>
	<div class="container-fluid padding-lg-0l padding-lg-0r greeting section">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="img_box">
						<img src="/resource//img/president.png" alt="대전 문화 예술의 중심 We are the pride of Daejeon!">
					</div>
				</div>
				<div class="col-md-7 padding-md-50t">
					<p>안녕하십니까? <br>대전의 문화예술발전에 앞장서는 한국예총 대전광역시연합회, 대전예총입니다. <br>대전 예총 홈페이지를 방문해 주셔서 대단히 감사합니다.</p>
					<p>대전예총은 건축가협회, 국악협회, 무용협회, 문인협회, 사진작가협회, 연극협회, 연예예술인협회, 영화인협회, 음악협회를 회원 협회로 하는 연합회입니다.</p>
					<p>예술이 좋아서 스스로 선택한 길을 인생 여정으로 생각하면서 평생 정진하는 사람이 되어 세상으로 부터 예술가라 불리기를 소망하는 예술인들로써 지향과 방법에 차이가 있을 뿐 예술을 향한 마음은 한 마음입니다.</p>
					<p>세상을 행복하게 하는 제일 효율적인 수단은 예술이라고 생각합니다.</p>
					<p>장르를 초월하여 통섭의 경지에 이르도록 상생협력하기를 바라는 여명에 부응 할 수 있도록 많은 격려와 성원하여 주시기 바랍니다.</p>
					<div class="img_box txt-right padding-lg-30t">
						<img src="/resource//img/name.jpg" alt="(사)한국예총 대전광역시연합회장 박홍준">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="site-search" id="search-box">
		<button class="close-btn js-close-search"><i class="fa fa-times" aria-hidden="true"></i></button>
		<div class="form-container">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<form role="search" method="get" class="search-form" action="http://ahetopro/" autocomplete="off">
							<div class="input-group">
								<input type="search" value="" name="s" class="search-field" placeholder="Enter Keyword" required="">
							</div>
						</form>
						<p class="search-description">Input your search keywords and press Enter.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Magnific popup -->
	<script src="/resource/js/jquery.magnific-popup.min.js"></script>
	<!-- anm -->
	<script src="/resource/js/anm.min.js"></script>
	<!-- Google maps -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARwCmK-LlGIH8Mv1ac4VyceMYUgg9vStM&amp;#038;&language=en"></script>
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