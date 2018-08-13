<?php
    include_once("../include/lib.php");

    if($_POST['board-name'] == ''){
        die('게시판 이름을 입력 해주세요.');
    }

    $pc = 'page_cnt'.$_POST['board_type'];

    $page_cnt = $_POST[$pc];

    $pdo->query("update board_set set name='{$_POST['board-name']}', type='{$_POST['board_type']}', line_cnt='{$_POST['line_cnt']}', page_cnt='{$page_cnt}', upload_cnt='{$_POST['file_cnt']}', upload_size='{$_POST['f_size']}' where idx='{$_POST['idx']}'");