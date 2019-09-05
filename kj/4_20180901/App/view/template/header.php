<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>전남관광명소</title>
    <link rel="stylesheet" href="<?php echo CSS_URL?>/default.css">
    <link rel="stylesheet" href="<?php echo CSS_URL?>/common.css">
    <script src="<?php echo JS_URL?>/jquery.min.js"></script>
    <script src="<?php echo JS_URL?>/script.js"></script>
</head>

<body>
    <div id="wrap">
        <div id="header" class="main-header">
            <div class="wrap">
                <div id="logo">
                    <h1><a href="<?php echo HOME_URL?>/">전남관광명소</a></h1>
                </div>

                <div id="util-menu">
                    <ul>
                        <li><a href="<?php echo HOME_URL?>/">홈</a></li>
                        <li><a href="#">E-mail : tour@yeosu.com</a></li>
                        <li><a href="#">Contents</a></li>
                        <li><button type="button" onclick="location.href = '<?php echo HOME_URL.'/admin/login'?>'">관리자모드</button></li>
                    </ul>
                </div>
            </div>

            <div id="main-menu" class="main-hd">
                <div class="wrap">
                    <ul class="menu">

                        <li><a href="#">Menu 1</a></li>

                        <li><a href="#">Menu 2</a></li>

                        <li><a href="#">Menu 3</a></li>
                    </ul>
                </div>

            </div>
        </div>