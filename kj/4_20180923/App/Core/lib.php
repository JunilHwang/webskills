<?php
namespace App\Core;

function alert ($msg) {
	echo "<script>alert('{$msg}')</script>";
}

function move ($url = false) {
	echo "<script>";
	echo $url ? "location.replace('{$url}')" : "history.back();";
	echo "</script>";
	exit;
}

function access ($bool, $msg, $url = false) {
	if (!$bool) {
		alert($msg);
		move($url);
	}
}

function print_pre ($ele) {
	echo "<pre>";
	print_r($ele);
	echo "</pre>";
}

function println ($ele) {
	echo "<p>{$ele}</p>";
}

function up_file ($file) {
	if (is_uploaded_file($file['tmp_name'])) {
		$tmp_name = $file['tmp_name'];
		$origin_name = $file['name'];
		$ext = strtolower(preg_replace("/(.*)\.(.*)/", "$2", $origin_name));
		$saved_name = time().'_'.rand().".{$ext}";
		if (!file_exists(_UPDIR)) mkdir(_UPDIR);
		if (move_uploaded_file($tmp_name, _UPDIR."/{$saved_name}")) {
			return [$origin_name, $saved_name];
		}
	}
	return null;
}

function text_cut ($text, $max) {
	$len = strlen($text);
	if ($len > $max) {
		$text = mb_substr($text, 0, $max, "UTF-8").'...';
	}
	return $text;
}


spl_autoload_register(function ($className) {
	$className = str_replace("\\", "/", $className);
	include_once(_ROOT."/{$className}.php");
});















