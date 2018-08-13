<?php
    include_once("../include/lib.php");

    $row = $pdo->query("select * from menu_set where m_dan='1'")->rowCount();

    if($row == 5){
        exit;
    }
    
    $pdo->query("insert into menu_set set s_ok='0', l_order=6, name='{$_POST['menu']}', m_active='1', m_dan=1, parent_idx='0'");
    
    die($pdo->query("select * from menu_set order by idx desc limit 1")->fetch(2)['idx']);