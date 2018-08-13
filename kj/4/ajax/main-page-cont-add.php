<?php
    include_once("../include/lib.php");

    $pdo->query("insert into main_page set parent_idx='{$_POST['idx']}'");
    die($pdo->query("select * from main_page order by idx desc limit 1")->fetch(2)['idx']);