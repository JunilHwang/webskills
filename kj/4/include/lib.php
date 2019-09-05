<?php
@header("content-type:text/html; charset=utf-8");
@session_start();

$pdo = new PDO("mysql:host=127.0.0.1;dbname=20180514;charset=utf8", "root", "");

date_default_timezone_set("Asia/Seoul");


function alert($msg){
    echo "<script>alert('{$msg}');</script>";
}

function move($url){
    echo "<script>";
        echo $url ? "document.location.replace('{$url}')" : "history.back()";
    echo "</script>";
    exit;
}

function msgMove($msg, $url){
    alert($msg);
    move($url);

}

$_SESSION['idx'] = isset($_SESSION['idx']) ? $_SESSION['idx'] : NULL;
$_SESSION['userid'] = isset($_SESSION['userid']) ? $_SESSION['userid'] : NULL;
$_SESSION['username'] = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;