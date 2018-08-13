<?php
    include_once("../include/lib.php");
    
    $pdo->query("insert into menu_set set s_ok='0', l_order=6, name='', m_active='1', m_dan=2, parent_idx='{$_POST['idx']}'");
    
    die($pdo->query("select * from menu_set order by idx desc limit 1")->fetch(2)['idx']);