<?php
    include_once("../include/lib.php");

    $pdo->query("update main_page set c_type=0, b_idx=0, def_img='', over_img='', l_url='', m_type='' where idx='{$_POST['idx']}'");