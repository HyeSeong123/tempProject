<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<!DOCTYPE html>
<html>

<%@ include file="../part/head.jspf"%>

<div class="container-fluid sub_bg">
	<div class="container">
		<h2 class="sub_tit">포토갤러리</h2>
	</div>
</div>
<div class="container-fluid padding-lg-0l padding-lg-0r section">
	<div class="container">
		<div class="tbl_top">
			<div class="sch">
				<a href="add?boardNum=${board.num}&redirectUrl=${encodedRequestUrl}">글쓰기</a>
				<form>
					<input type="hidden" name="boardNum" value="${board.num}" /> <select
						name="searchKeywordType" id="">
						<option value="제목">제목</option>
						<option value="내용">내용</option>
						<option value="제목과내용">제목+내용</option>
					</select> <input type="text" class="sch_input" name="searchKeyword"
						value="${param.searchKeyword}">

					<button class="sch_btn" type="submit">
						<i class="icon ti-search"></i>검색
					</button>
				</form>

			</div>
		</div>
		<div class="gallery_wrap">
			<ul class="gallery_ul">

				<c:forEach items="${articles}" var="article">
					<li><a href="detail?num=${article.num}&redirectUrl=${encodedRequestUrl}">
							<div class="img_box">
								<img src="${article.extra__thumbImg}" alt="이미지 등록 안됨">
							</div>
							<div class="gal_txt">
								<p>${article.title}</p>
								<div>
									<span>${article.regDate} </span>
									<i>${article.extra__writer}</i>
								</div>
							</div>
					</a></li>
				</c:forEach>
			</ul>
		</div>
		<div class="paging">
			<ul class="pagination">
				<c:if test="${page != pageMenuStart}">
					<li><a
						href="photoList?boardNum=${board.num}&page=1&searchKeyword=${param.searchKeyword}&searchKeywordType=${param.searchKeywordType}"
						class="ctrl fir" onclick=""><span class="blind">처음</span></a></li>

					<li><a
						href="photoList?boardNum=${board.num}&page=${page-1}&searchKeyword=${param.searchKeyword}&searchKeywordType=${param.searchKeywordType}"
						class="ctrl prev" onclick=""><span class="blind">이전</span></a></li>

				</c:if>


				<c:forEach var="i" begin="${pageMenuStart}" end="${pageMenuEnd}">
					<li><c:set var="className" value="${i==page ? 'active' : ''}" />
						<a class="${className} num"
						href="photoList?boardNum=${board.num}&page=${i}&searchKeyword=${param.searchKeyword}&searchKeywordType=${param.searchKeywordType}">${i}</a>
					</li>
				</c:forEach>

				<c:if test="${page != pageMenuEnd and totalCount != 0}">
					<li><a
						href="photoList?boardNum=${board.num}&page=${page+1}&searchKeyword=${param.searchKeyword}&searchKeywordType=${param.searchKeywordType}"
						class="ctrl next" onclick=""><span class="blind">다음</span></a></li>

					<li><a
						href="photoList?boardNum=${board.num}&page=${pageMenuEnd}&searchKeyword=${param.searchKeyword}&searchKeywordType=${param.searchKeywordType}"
						class="ctrl las" onclick=""><span class="blind">마지막</span></a></li>
				</c:if>
			</ul>
		</div>
	</div>
</div>

<%@ include file="../part/foot.jspf"%>