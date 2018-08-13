<?php
    include_once("../include/lib.php");
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

            <div id="contents">
                <div class="login-frm">
                    <div class="wrap">
                        <div class="frm-title">
                            <h3>로그인</h3>
                        </div>
                        <form method="post" onsubmit="return frmSubmit(this, '/ajax/login-ok.php', '로그인이 완료되었습니다.', '/admin/index.php');">
                            <input type="text" name="userid" id="userid" placeholder="아이디">

                            <input type="password" name="pw" id="pw" placeholder="비밀번호">

                            <button type="submit">로그인</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="footer">
                <div class="copy">
                    <p>COPYRIGHT (c) 2018 ALL RIGHTS RESERVED.</p>
                </div>
            </div>
        </div>

    </body>

    </html>
