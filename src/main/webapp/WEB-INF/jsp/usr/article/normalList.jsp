<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<!DOCTYPE html>
<html>

<%@ include file="../part/head.jspf"%>

    <div class="container-fluid sub_bg">
        <div class="container">
            <h2 class="sub_tit">${board.name}</h2>
        </div>
    </div>
    <div class="container-fluid padding-lg-0l padding-lg-0r section">
        <div class="container">
            <div class="tbl_top">
                <div class="sch">
                <a href="add?boardNum=${board.num}&redirectUrl=${encodedRequestUrl}">글쓰기</a>
                	<form>
                		<input type="hidden" name="boardNum" value="${board.num}"/>
	                    <select name="searchKeywordType" id="">
	                        <option value="제목">제목</option>
	                        <option value="내용">내용</option>
	                        <option value="제목과내용">제목+내용</option>
	                    </select>
	                    
	                    <input type="text" class="sch_input" name="searchKeyword" value="${param.searchKeyword}">
	                    
	                    <button class="sch_btn" type="submit"><i class="icon ti-search"></i>검색</button>
	                 </form>
	                 
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
                    <c:if test="${articles.size() == 0}">
                    <td></td>
                    <td>검색 조건의 게시글이 존재하지 않습니다.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                    </c:if>
	                    <c:forEach items="${articles}" var="article">
							<tr>
								<td> ${article.num}</td>
								<td><a href="detail?num=${article.num}&redirectUrl=${encodedRequestUrl}">${article.title}</a></td>
								<td> ${article.extra__writer}</td>
								<td> ${article.regDate}</td>
								<td> ${article.view}</td>
							</tr>	
						</c:forEach>                       
                    </tbody>
                </table>
            </div>
            <div class="paging">
                <ul class="pagination">
                
                	<c:if test="${page != pageMenuStart}">
	                    <li>
	                        <a href="normalList?boardNum=${board.num}&page=1&searchKeyword=${param.searchKeyword}&searchKeywordType=${param.searchKeywordType}" class="ctrl fir" onclick=""><span class="blind">처음</span></a>
	                    </li>

	                    <li>
	                        <a href="normalList?boardNum=${board.num}&page=${page-1}&searchKeyword=${param.searchKeyword}&searchKeywordType=${param.searchKeywordType}" class="ctrl prev" onclick=""><span class="blind">이전</span></a>
	                    </li>
	                    
                    </c:if>
                    
                   
                    <c:forEach var="i" begin="${pageMenuStart}" end="${pageMenuEnd}">
                    	<li>
	                    	<c:set var="className" value="${i==page ? 'active' : ''}" />
							<a class="${className} num" href="normalList?boardNum=${board.num}&page=${i}&searchKeyword=${param.searchKeyword}&searchKeywordType=${param.searchKeywordType}">${i}</a>
						</li>
                    </c:forEach>
                    
                    <c:if test="${page != pageMenuEnd and totalCount != 0}">
	                    <li>
	                        <a href="normalList?boardNum=${board.num}&page=${page+1}&searchKeyword=${param.searchKeyword}&searchKeywordType=${param.searchKeywordType}" class="ctrl next" onclick=""><span class="blind">다음</span></a>
	                    </li>
	                    
	         			<li>
	                        <a href="normalList?boardNum=${board.num}&page=${pageMenuEnd}&searchKeyword=${param.searchKeyword}&searchKeywordType=${param.searchKeywordType}" class="ctrl las" onclick=""><span class="blind">마지막</span></a>
	                    </li>
                    </c:if>
                    
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