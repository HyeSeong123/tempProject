<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<!DOCTYPE html>
<html>

<%@ include file="../part/head.jspf"%>

<c:set var="fileInputMaxCount" value="10" />

<script>
	ArticleAdd__fileInputMaxCount = parseInt("${fileInputMaxCount}");
</script>
 
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
				return false;
			}
			
			form.body.value = form.body.value.trim();
			
			if ( form.body.value.length == 0 ){
				alert('게시글의 내용을 입력해주세요');
				form.body.focus();
				return false;
			}
			
			var maxSizeMb = 5;
			var maxSize = maxSizeMb * 1024 * 1024;
			
			for( let inputNo = 1; inputNo <= ArticleAdd__fileInputMaxCount; inputNo++){
				const input = form["file__article__0__common__attachment__" + inputNo];
			
				if (input.value){
					if(input.files[0].size > maxSize){
						alert(maxSizeMb + "MB 이하의 파일을 업로드 해주세요.");
						input.focus();
						
						return;
					}
				}
			}
			
			const startSubmitForm = function(data){
				if (data && data.body && data.body.genFileIdsStr){
					form.genFileIdsStr.value = data.body.genFileIdsStr;
				}
				
				form.genFileIdsStr.value = data.body.genFileIdsStr;
				
				for(let inputNo = 1; inputNo <= ArticleAdd__fileInputMaxCount; inputNo++){
					const input = form["file__article__0__common__attachment__" + inputNo];
					input.value = '';
				}
				
				form.submit();
			};
			
	const startUploadFiles = function(onSuccess) {
		var needToUpload = false;
		for ( let inputNo = 1; inputNo <= ArticleAdd__fileInputMaxCount; inputNo++ ) {
			const input = form["file__article__0__common__attachment__" + inputNo];
			if ( input.value.length > 0 ) {
				needToUpload = true;
				break;
			}
		}
		
		if (needToUpload == false) {
			onSuccess();
			return;
		}
				
				var fileUploadFormData = new FormData(form);
				$.ajax({
					url : '/common/genFile/doUpload',
					data : fileUploadFormData,
					processData : false,
					contentType : false,
					dataType : "json",
					type : 'POST',
					success : onSuccess
				});
			}
			addArticleForm_submited = true;
			
			startUploadFiles(startSubmitForm);
		}
	</script>

			<form action="doAddTest" method="POST" onsubmit="addArticleFormSubmit(this); return false;" enctype="multipart/form-data">

				<input type="hidden" name="boardNum" value="${param.boardNum}" />
				<input type="hidden" name="genFileIdsStr" value=""/>
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
						
						<c:forEach begin="1" end="${fileInputMaxCount}" var="inputNo"> 
							<tr>
								<th>첨부파일 ${inputNo }</th>
								<td><input type="file" name="file__article__0__common__attachment__${inputNo}"></td>
							</tr>
						</c:forEach>

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