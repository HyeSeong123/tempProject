<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<!DOCTYPE html>
<html>

<%@ include file="../part/head.jspf"%>

    <div class="container-fluid sub_bg">
        <div class="container">
            <h2 class="sub_tit">공지사항</h2>
        </div>
    </div>
    <div class="container-fluid padding-lg-0l padding-lg-0r section">
        <div class="container">
            <div class="tbl_top">
                <div class="sch">
                    <select name="" id="">
                        <option value="">제목</option>
                        <option value="">내용</option>
                        <option value="">제목+내용</option>
                    </select>
                    <input type="text" class="sch_input">
                    <button class="sch_btn"><i class="icon ti-search"></i>검색</button>
                </div>
            </div>
            <div class="tbl_wrap">
                <table class="list">
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>글쓴이</th>
                            <th>날짜</th>
                            <th>조회</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10</td>
                            <td><a href="http://www.yechong.or.kr/bbs/board.php?bo_table=ye_05_01&amp;wr_id=314">한국예총 예술정기후원 프로젝트 </a></td>
                            <td>대전예총 </td>
                            <td>03-04</td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td><a href="http://www.yechong.or.kr/bbs/board.php?bo_table=ye_05_01&amp;wr_id=314">한국예총 예술정기후원 프로젝트 </a></td>
                            <td>대전예총 </td>
                            <td>03-04</td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td><a href="http://www.yechong.or.kr/bbs/board.php?bo_table=ye_05_01&amp;wr_id=314">한국예총 예술정기후원 프로젝트 </a></td>
                            <td>대전예총 </td>
                            <td>03-04</td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td><a href="http://www.yechong.or.kr/bbs/board.php?bo_table=ye_05_01&amp;wr_id=314">한국예총 예술정기후원 프로젝트 </a></td>
                            <td>대전예총 </td>
                            <td>03-04</td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td><a href="http://www.yechong.or.kr/bbs/board.php?bo_table=ye_05_01&amp;wr_id=314">한국예총 예술정기후원 프로젝트 </a></td>
                            <td>대전예총 </td>
                            <td>03-04</td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><a href="http://www.yechong.or.kr/bbs/board.php?bo_table=ye_05_01&amp;wr_id=314">한국예총 예술정기후원 프로젝트 </a></td>
                            <td>대전예총 </td>
                            <td>03-04</td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><a href="http://www.yechong.or.kr/bbs/board.php?bo_table=ye_05_01&amp;wr_id=314">한국예총 예술정기후원 프로젝트 </a></td>
                            <td>대전예총 </td>
                            <td>03-04</td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="http://www.yechong.or.kr/bbs/board.php?bo_table=ye_05_01&amp;wr_id=314">한국예총 예술정기후원 프로젝트 </a></td>
                            <td>대전예총 </td>
                            <td>03-04</td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="http://www.yechong.or.kr/bbs/board.php?bo_table=ye_05_01&amp;wr_id=314">한국예총 예술정기후원 프로젝트 </a></td>
                            <td>대전예총 </td>
                            <td>03-04</td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><a href="http://www.yechong.or.kr/bbs/board.php?bo_table=ye_05_01&amp;wr_id=314">한국예총 예술정기후원 프로젝트 </a></td>
                            <td>대전예총 </td>
                            <td>03-04</td>
                            <td>19</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="paging">
                <ul class="pagination">
                    <li>
                        <a href="#" class="ctrl fir" onclick=""><span class="blind">처음</span></a>
                    </li>
                    <li>
                        <a href="#" class="ctrl prev" onclick=""><span class="blind">이전</span></a>
                    </li>
                    <li>
                        <a href="#" class="num" onclick="">1</a>
                    </li>
                    <li>
                        <a href="#" class="num active">2</a>
                    </li>
                    <li>
                        <a href="#" class="num" onclick="">3</a>
                    </li>
                    <li>
                        <a href="#" class="num" onclick="">4</a>
                    </li>
                    <li>
                        <a href="#" class="ctrl next" onclick=""><span class="blind">다음</span></a>
                    </li>
                    <li>
                        <a href="#" class="ctrl las" onclick=""><span class="blind">마지막</span></a>
                    </li>
                </ul>
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