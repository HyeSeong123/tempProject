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
                    <select name="" id="">
                        <option value="">제목</option>
                        <option value="">내용</option>
                        <option value="">제목+내용</option>
                    </select>
                    <input type="text" class="sch_input">
                    <button class="sch_btn"><i class="icon ti-search"></i>검색</button>
                </div>
            </div>
            <div class="gallery_wrap">
                <ul class="gallery_ul">
                    <li>
                        <a href="#">
                            <div class="img_box">
                                <img src="/resource/img/sample.jpg" alt="">
                            </div>
                            <div class="gal_txt">
                                <p>제목</p>
                                <div><span>2020-05-24 </span><i>대전예총</i></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="img_box">
                                <img src="/resource/img/sample.jpg" alt="">
                            </div>
                            <div class="gal_txt">
                                <p>제목이 들어갑니다</p>
                                <div><span>2020-05-24 </span><i>대전예총</i></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="img_box">
                                <img src="/resource/img/sample.jpg" alt="">
                            </div>
                            <div class="gal_txt">
                                <p>제목</p>
                                <div><span>2020-05-24 </span><i>대전예총</i></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="img_box">
                                <img src="/resource/img/sample.jpg" alt="">
                            </div>
                            <div class="gal_txt">
                                <p>제목</p>
                                <div><span>2020-05-24 </span><i>대전예총</i></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="img_box">
                                <img src="/resource/img/sample.jpg" alt="">
                            </div>
                            <div class="gal_txt">
                                <p>제목</p>
                                <div><span>2020-05-24 </span><i>대전예총</i></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="img_box">
                                <img src="/resource/img/sample.jpg" alt="">
                            </div>
                            <div class="gal_txt">
                                <p>제목</p>
                                <div><span>2020-05-24 </span><i>대전예총</i></div>
                            </div>
                        </a>
                    </li>
                </ul>
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
    
    <%@ include file="../part/foot.jspf"%>