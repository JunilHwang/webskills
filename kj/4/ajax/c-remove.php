<?php
    include_once("../include/lib.php");

    $pdo->query("update main_image set {$_POST['arrow']}_back=''");