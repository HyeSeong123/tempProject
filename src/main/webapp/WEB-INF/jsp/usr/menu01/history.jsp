<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<!DOCTYPE html>
<html>

<%@ include file="../part/head.jspf"%>

    <div class="container-fluid sub_bg">
        <div class="container">
            <h2 class="sub_tit">연혁</h2>
        </div>
    </div>
    <div class="container-fluid padding-lg-0l padding-lg-0r greeting section">
        <div class="container">
            <div class="row padding-lg-30b">
                <div class="col-md-12">
                    <h3>단체명</h3>
                    <ul class="cont_ul">
                        <li><span>명칭</span>사단법인 한국예술문화단체총연합회 대전광역시연합회</li>
                        <li><span>통칭</span>사단법인 한국예총 대전광역시연합회</li>
                        <li><span>약칭</span>대전예총</li>
                    </ul>
                </div>
            </div>
            <div class="row padding-lg-30b">
                <div class="col-md-12">
                    <h3>대전예총</h3>
                    <p>대전예총은 한국예술문화단체총연합회 대전광역시연합회의 약칭이며, 지역사회의 예술문화 발전과 창달을 목적으로 1962년 설립된 순수 전문예술인단체모임으로 건축, 국악, 무용, 문인, 미술, 사진, 연극, 연예, 영화, 음악 등 10개의 회원단체가 구성되어 있으며 소속회원 5,000여명에 이르는 대전을 대표하는 예술문화단체입니다.</p>
                </div>
            </div>
            <div class="row margin-lg-100b margin-md-60b">
                <div class="col-md-12">
                    <h3>대전예총</h3>
                    <ul class="history">
                        <li><span>1962.03</span>
                            <p>한국예술문화단체총연합회 충청남도지부(초대지부장 李在福)로 인준</p>
                        </li>
                        <li><span>1989.01.01</span>
                            <p>행정구역 개편으로 대전시가 대전직할시로 승격됨에 따라 대전·충남지회로 조직변경</p>
                        </li>
                        <li><span>1992.01</span>
                            <p>대전직할시지회와 충청남도지회의 조직 분리</p>
                        </li>
                        <li><span>1995</span>
                            <p>대전직할시 명칭이 대전광역시로 변경됨에 따라 본회도 대전광역시 연합회로 조직변경</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="history_list">
                        <li>
                            <span>대전직할시 초대지회장</span>
                            <p><i>조종국</i>미술 1989.03~1992.02</p>
                        </li>
                        <li>
                            <span>대전직할시 제2대지회장</span>
                            <p><i>조종국</i>미술 1992.03~1995.02</p>
                        </li>
                        <li>
                            <span>대전광역시 제3대지회장</span>
                            <p><i>윤필수</i>사진 1995.03~1998.01</p>
                        </li>
                        <li>
                            <span>대전광역시 제4대지회장</span>
                            <p><i>정명희</i>미술 1998.01.23~1999.04.17</p>
                        </li>
                        <li>
                            <span>대전광역시 제4대지회장</span>
                            <p><i>직무대행 이길웅</i>영화 1999.04.18~05.20</p>
                        </li>
                        <li>
                            <span>대전광역시 제4대지회장(보궐)</span>
                            <p><i>조종국</i>미술 1999.05.21~2001.01</p>
                        </li>
                        <li>
                            <span>대전광역시 제5대지회장</span>
                            <p><i>조종국</i>미술 2001.02~2004.02</p>
                        </li>
                        <li>
                            <span>대전광역시 제6대연합회장</span>
                            <p><i>조종국</i>미술 2004.02~2007.01</p>
                        </li>
                        <li>
                            <span>대전광역시 제7대연합회장</span>
                            <p><i>최남인</i>음악 2007.02~2011.01</p>
                        </li>
                        <li>
                            <span>대전광역시 제8대연합회장</span>
                            <p><i>최남인</i>음악 2011.01~2015.02</p>
                        </li>
                        <li>
                            <span>대전광역시 제9대연합회장</span>
                            <p><i>최영란</i>무용 2015.02~2017.06</p>
                        </li>
                        <li>
                            <span>대전광역시 제10대연합회장</span>
                            <p><i>박홍준</i>미술 2017.08~현재</p>
                        </li>
                    </ul>
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


<%@ include file="../part/foot.jspf"%>