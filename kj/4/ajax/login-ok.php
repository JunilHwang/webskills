<?php
include_once("../include/lib.php");

$idChk = $pdo->query("select * from member where userid='{$_POST['userid']}' and pw='{$_POST['pw']}'")->fetch(2);

if($idChk){
    $_SESSION['idx'] = $idChk['idx'];
    $_SESSION['userid'] = $idChk['userid'];
    $_SESSION['username'] = $idChk['username'];
} else {
    die('아이디 또는 비밀번호가 일치하지 않습니다.');
}