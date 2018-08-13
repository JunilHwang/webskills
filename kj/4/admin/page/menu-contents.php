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

        <div id="contents" class="menu_contents">
            <div class="wrap">
                <div class="page-title">
                   <h3>메뉴별 컨텐츠</h3>
                </div>
               
                <table>
                    <thead>
                        <th>1차 메뉴</th>
                        <th>2차 메뉴</th>
                        <th>컨텐츠 구성</th>
                    </thead>
                    
                    <tbody>
                        <?php
                            $list = $pdo->query("select * from menu_set where m_dan='1' order by l_order asc");
                            while($list_r = $list->fetch(2)){
                        ?>
                        <tr>
                            <td style="background-color:#3a3a3a; color:#fff;"><?= $list_r['name'] ?></td>
                            <td></td>
                            <td>
                                <?php
                                if($list_r['c_type'] == '0'){
                                ?>
                                미설정 
                                <?php } else if($list_r['c_type'] == '2'){ ?>
                                HTML
                                <?php } else if($list_r['c_type'] == '3'){ ?>
                                게시판 - <?= $pdo->query("select * from board_set where idx='{$list_r['c_text']}'")->fetch(2)['name'] ?>
                                <?php } ?>
                            <button type="button" class="cont-change" onclick="window.open('/popup/menu-contents.php?idx=<?= $list_r['idx'] ?>', '', 'width=600, height=500');" >변경</button></td>
                        </tr>
                        <?php
                            $list2 = $pdo->query("select * from menu_set where m_dan='2' and parent_idx='{$list_r['idx']}' order by l_order asc");
                            while($list_r2 = $list2->fetch(2)){
                        ?>
                        <tr>
                            <td></td>
                            <td style="background-color:#3a3a3a; color:#fff;"><?= $list_r2['name'] ?></td>
                            <td><?php
                                if($list_r2['c_type'] == '0'){
                                ?>
                                미설정 
                                <?php } else if($list_r2['c_type'] == '2'){ ?>
                                HTML
                                <?php } else if($list_r2['c_type'] == '3'){ ?>
                                게시판 - <?= $pdo->query("select * from board_set where idx='{$list_r2['c_text']}'")->fetch(2)['name'] ?>
                                <?php } ?>
                                 <button type="button" class="cont-change" onclick="window.open('/popup/menu-contents.php?idx=<?= $list_r2['idx'] ?>', '', 'width=600, height=500');" >변경</button></td>
                        </tr>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="footer">
            <div class="copy">
                <p>COPYRIGHT (c) 2018 ALL RIGHTS RESERVED.</p>
            </div>        
        </div>
    </div>

</body></html>