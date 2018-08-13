<?php
    include_once("../include/lib.php");

    if(!isset($_POST['first_menu_title'])){
        die('메뉴가 존재하지 않습니다.');
    }

    foreach($_POST['first_menu_title'] as $k=>$v){
        if($v == ''){
            $pdo->query("delete from menu_set where idx='{$_POST['first_menu_idx'][$k]}'");
        } else {
            $pdo->query("update menu_set set l_order='{$k}', name='{$v}' where idx='{$_POST['first_menu_idx'][$k]}'");
        }
    }
    if(isset($_POST['two_menu_title'])){
        foreach($_POST['two_menu_title'] as $k=>$v){
            if($v == ''){
                $pdo->query("delete from menu_set where idx='{$_POST['two_menu_idx'][$k]}'");
            } else {
                $pdo->query("update menu_set set l_order='{$k}', name='{$v}' where idx='{$_POST['two_menu_idx'][$k]}'");
            }
        }
    }

    foreach($_POST['menu1_switch'] as $k=>$v){
        $pdo->query("update menu_set set m_active='{$v}' where idx='{$_POST['first_menu_idx'][$k]}'");
    }

    foreach($_POST['menu2_switch'] as $k=>$v){
        $pdo->query("update menu_set set m_active='{$v}' where idx='{$_POST['two_menu_idx'][$k]}'");
    }
    
    $pdo->query("update menu_set set s_ok=1");

    if(isset($_POST['parent_menu_remove'])){
        foreach($_POST['parent_menu_remove'] as $k=>$v){
            $pdo->query("delete from menu_set where idx='{$v}'");
        }
    }
    
