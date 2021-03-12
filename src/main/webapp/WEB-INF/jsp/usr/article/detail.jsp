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
		<div class="tbl_wrap">
			<table class="view">
				<colgroup>
					<col style="width: *;">
					<col style="width: 100px;">
				</colgroup>
				<tbody>
					<tr>
						<td class="view_tit">${article.title}</td>
						<td><a href="modify?num=${article.num}">글 수정</a></td>
						
						<td><a href="doDelete?num=${article.num}">글 삭제</a></td>
						
						<td>${article.regDate}</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="cont">
								${article.body}
							</div>
						</td>
					</tr>
					<tr>
						<td class="attach" colspan="2"><a href="#"><i
								class="icon ti-download"></i>제33회 예총예술문화상 수상자 발표.hwp</a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="btn_group">
			<a href="${redirectUrl}" class="btn btn_blue">목록</a>
		</div>
	</div>
</div>



<%@ include file="../part/foot.jspf"%>