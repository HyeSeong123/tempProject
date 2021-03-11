<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>


<c:if test="${param.boardNum=1}">
	<%@ include file="normalList.jsp"%>
</c:if>

<c:if test="${param.boardNum=2}">
	<%@ include file="photoList.jsp"%>
</c:if>