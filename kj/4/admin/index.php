<?php
    include_once("../include/lib.php");

    if($_SESSION['userid'] != 'root'){
        msgMove('관리자만 접근가능합니다.', './login.php');
    }
?>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>관리자</title>

    <link rel="stylesheet" href="/css/default.css">

    <link rel="stylesheet" href="/admin/css/admin.css">

    <script src="/js/jquery.min.js"></script>

    <script type="text/javascript" src="/js/jquery-ui.js"></script>

    <script src="/js/script.js"></script>
</head>

<body>
    <div id="wrap" class="admin">
        <?php
            include_once("header.php");
        ?>
        <div id="wrap" class="admin">
            <div id="header">
            </div>

            <div id="contents">
                <div class="wrap">
                    <div class="admin-main">
                        <ul>
                            <li>관리자 페이지 입니다.</li>
                            <li>상단 관리메뉴를 선택하여 웹사이트를 구축하세요</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="footer">
                <div class="copy">
                    <p>COPYRIGHT (c) 2018 ALL RIGHTS RESERVED.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
