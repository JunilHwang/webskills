<?php
    include_once("../include/lib.php");
    
    $c_text = $_POST['type'] == '2' ? $_POST['text'] : $_POST['board'];

    if($c_text == ''){
        die('누락 항목이 존재합니다.');
    }

    $pdo->query("update menu_set set c_type='{$_POST['type']}', c_text='{$c_text}' where idx='{$_POST['idx']}'");