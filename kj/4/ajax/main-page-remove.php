<?php
    include_once("../include/lib.php");

    $pdo->query("delete from main_page where idx='{$_POST['idx']}'");