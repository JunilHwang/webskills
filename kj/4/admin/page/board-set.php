<?php
    include_once("{$_SERVER['DOCUMENT_ROOT']}/include/lib.php");

    if($_SESSION['userid'] != 'root'){
        msgMove('관리자만 접근가능합니다.', '../login.php');
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
            include_once("../header.php");
        ?>

            <div id="contents" class="board-set">
                <div class="wrap">
                    <div class="page-title">
                        <h3>게시판 설정</h3>
                    </div>

                    <div class="board-cnt">
                        <h5>게시판</h5>
                    </div>

                    <div class="board-table">
                        <table>
                            <colgroup>
                                <col style="width:15%">
                                <col style="width:50%">
                                <col style="width:15%">
                                <col style="width:20%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>게시판 이름</th>
                                    <th>게시글 총개수</th>
                                    <th>수정/삭제</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $list = $pdo->query("select * from board_set");
                                    while($list_r = $list->fetch(2)){
                                ?>
                                <tr>
                                    <td><?= $list_r['name'] ?></td>
                                    <td><?= $pdo->query("select * from board where bds_idx='{$list_r['idx']}'")->rowCount(); ?></td>
                                    <td><button type="button" onclick="link('./board-set-modify.php?idx=<?= $list_r['idx'] ?>');">수정/삭제</button></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="save-btn">
                        <button type="button" onclick="link('./board-set-add.php');">게시판 생성</button>
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
