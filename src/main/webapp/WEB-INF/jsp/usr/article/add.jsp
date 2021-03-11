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
		<div class="tbl_wrap">

	<script>
		function addArticleFormSubmit(form){
			let addArticleForm_submited = false;
			
			if (addArticleForm_submited) {
					alert('처리중입니다.');
					return;
				}
				
			form.title.value = form.title.value.trim();
			
			if ( form.title.value.length == 0 ){
				alert('게시글의 제목을 입력해주세요');
				form.title.focus();
				return;
			}
			
			form.body.value = form.body.value.trim();
			
			if ( form.body.value.length == 0 ){
				alert('게시글의 내용을 입력해주세요');
				form.body.focus();
				return;
			}
			
			form.submit();
			addArticleForm_submited = true;
		}
	</script>

			<form action="doAddTest" method="POST" onsubmit="addArticleFormSubmit(this); return false;" enctype="multipart/form-data">

				<input type="hidden" name="boardNum" value="${param.boardNum}" />
				<table class="write">
					<colgroup>
						<col style="width: 100px;">
						<col style="width: *;">
					</colgroup>
					<tbody>
						<tr>
							<th>제목</th>
							<td><input type="text" name="title"></td>
						</tr>
						<tr>
							<th>글쓴이</th>
							<td><input type="text" name="extra_writer" value="${loginedMember.name}" readonly></td>
						</tr>
						<tr>
							<th>내용</th>
							<td><textarea name="body" id="" cols="30" rows="10"></textarea></td>
						</tr>
						
						<tr>
							<th>첨부파일1</th>
							<td><input type="file" name="file__article__0__common__attachment__1"></td>
						</tr>
						
						<tr>
							<th>첨부파일2</th>
							<td><input type="file" name="file__article__0__common__attachment__2"></td>
						</tr>
					</tbody>
				</table>
				
				<div class="btn_group center">
					<a href="${param.redirectUrl}" class="btn btn_blue">취소</a>
					<input type="submit" class="btn btn_gold" value="저장"></input>
				</div>

			</form>
		</div>

		<!-- 
		<div class="btn_group center">
			<a href="${param.redirectUrl}" class="btn btn_blue">취소</a>
			<a href="#" class="btn btn_gold">저장</a>
		</div>
		 -->

	</div>
</div>

<%@ include file="../part/foot.jspf"%>