<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<!DOCTYPE html>
<html>

<%@ include file="../part/head.jspf"%>

    <div class="container-fluid sub_bg">
        <div class="container">
            <h2 class="sub_tit">기구표</h2>
        </div>
    </div>
    <div class="container-fluid padding-lg-0l padding-lg-0r greeting section">
        <div class="container">
            <div class="row padding-lg-30b">
                <div class="col-md-12">
                    <div class="img_box">
                        <img src="/resource/img/group.jpg" alt="대전예총 기구표">
                    </div>
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