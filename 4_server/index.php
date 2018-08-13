<?php
	// lib
	include_once("./config/config.php");
	include_once("./config/lib.php");

	// file  download
	if(isset($_GET['q'])){
		outShare();
		return;
	}

	if(isset($_POST['action'])){
		include_once(VIEW_PATH."/{$type}/action.php");
		exit;
	}
	include_once(VIEW_PATH."/template/header.php");
	include_once(VIEW_PATH."/{$type}/{$include_file}.php");
	include_once(VIEW_PATH."/template/footer.php");