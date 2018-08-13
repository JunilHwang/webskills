<?php
    include_once("../include/lib.php");

    $pdo->query("insert into main_image set l_order='99'");
    die($pdo->query("select * from main_image order by l_order desc limit 1")->fetch(2)['idx']);