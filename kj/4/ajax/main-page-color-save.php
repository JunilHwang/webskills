<?php
    include_once("../include/lib.php");

    $pdo->query("update main_page set t_line='{$_POST['top_line']}', b_color='{$_POST['back-color']}', b_line='{$_POST['bot_line']}' where idx='{$_POST['idx']}'");

    