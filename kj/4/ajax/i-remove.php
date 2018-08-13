<?php
    include_once("../include/lib.php");

    $pdo->query("update main_image set m_img='' where idx='{$_POST['idx']}'");