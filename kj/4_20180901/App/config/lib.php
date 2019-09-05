<?php
	namespace App;

	function alert ($msg) {
		echo "<script>alert('{$str}')</script>";
	}

	function move ($url = false) {
		echo '<script>';
		echo $str ? "location.replace('{$str}')" : "history.back();";
		echo '</script>';
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

	spl_autoload_register(function ($className) {
		$className = str_replace("\\", "/", $className);
		include_once(_ROOT.'/'.$className.'.php');
	});