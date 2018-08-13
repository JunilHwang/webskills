<?php
    include_once("../include/lib.php");

    if(isset($_POST['m_page1'])){
        foreach($_POST['m_page1'] as $k=>$v){
            $pdo->query("update main_page set l_order='{$k}' where idx='{$v}'");
        }
    }

    if(isset($_POST['m_page2'])){
        foreach($_POST['m_page2'] as $k=>$v){
            $pdo->query("update main_page set l_order='{$k}' where idx='{$v}'");
        }
    }
    
    if(isset($_POST['remove-chk'])){
        foreach($_POST['remove-chk'] as $k=>$v){
            $pdo->query("delete from main_page where idx='{$v}'");
        }
    }