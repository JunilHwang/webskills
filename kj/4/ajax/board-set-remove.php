<?php
    include_once("../include/lib.php");

    $pdo->query("delete from board_set where idx='{$_POST['idx']}'");