<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<!DOCTYPE html>
<html>

<%@ include file="../part/head.jspf"%>

	<div class="container-fluid sub_bg">
		<div class="container">
			<h2 class="sub_tit">찾아오시는 길</h2>
		</div>
	</div>
	<div class="container">
		<div class="map">
			<iframe
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3214.587725633417!2d127.41386631556331!3d36.322303302153024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3565492d0acd5835%3A0xc95e7ffeeeaaf0e4!2z64yA7KCE7JiI7Iig6rCA7J2Y7KeR!5e0!3m2!1sko!2skr!4v1615114883192!5m2!1sko!2skr"
				width="600" height="450" style="border: 0;" allowfullscreen=""
				loading="lazy"></iframe>
		</div>
	</div>
	<div class="container section location">
		<div class="contact-single-wrap__contacts">
			<div
				class="row padding-lg-50t padding-lg-60b padding-md-65t padding-sm-40t">
				<div class="col-md-4 padding-sm-35b">
					<div
						class="aheto-contact aheto-contact--simple aheto-contact--dvder  t-center">
						<i class="aheto-contact__icon icon ti-mobile"></i>
						<h6 class="aheto-contact__type t-uppercase t-medium">Phone</h6>
						<a class="aheto-contact__link aheto-contact__info"
							href="tel:(042)2527187">(042)252-7187~8</a>
					</div>
				</div>
				<div class="col-md-4 padding-sm-35b">
					<div
						class="aheto-contact aheto-contact--simple aheto-contact--dvder  t-center">
						<i class="aheto-contact__icon icon ti-map-alt"></i>
						<h6 class="aheto-contact__type t-uppercase t-medium">Address</h6>
						<p class="aheto-contact__info">
							대전광역시 중구 중앙로32 <br>대전예술가의 집 5층 503호
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="aheto-contact aheto-contact--simple  t-center">
						<i class="aheto-contact__icon icon ti-email"></i>
						<h6 class="aheto-contact__type t-uppercase t-medium">Email</h6>
						<a class="aheto-contact__link aheto-contact__info"
							href="mailto:djart21@hanmail.net">djart21@hanmail.net</a>
					</div>
				</div>
			</div>
			<div class="traffic">
				<h3>교통안내</h3>
				<div class="box_wrap">
					<div class="box">
						<h4>버스</h4>
						<p class="m5">대전충남병무청 정거장에서 차 후 중앙로 방면으로 도보 2분 거리</p>
						<ul class="cont_ul">
							<li><span>간선</span>101, 103, 201, 202, 311, 314, 612, 613,
								701</li>
							<li><span>지선</span>513, 614</li>
							<li><span>급행</span>1</li>
							<li><span>외곽</span>30, 33</li>
						</ul>
					</div>
					<div class="box">
						<h4>승용차</h4>
						<p>옛 연정국악문화회관 위치</p>
					</div>
					<div class="box" class="box">
						<h4>지하철</h4>
						<p>서대전 네거리역 7번 출구로 나와 중앙로 방면 도보 3분 거리</p>
					</div>
					<div class="box">
						<h4>주차장</h4>
						<p>건물 지하 1층 주차장 이용</p>
					</div>
				</div>
			</div>
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
	<script src="/resource/js/anm.min.js"></script>
	<!-- FullCalendar -->
	<!-- Parallax -->
	<script src="/resource/js/parallax.min.js"></script>
	<!-- asRange -->
	<script src="/resource/js/jquery.range-min.js"></script>

</body>

<%@ include file="../part/foot.jspf"%>