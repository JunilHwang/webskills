<?php
	// 메시지 출력
	function alert($msg){
		echo "<script>alert('{$msg}')</script>";
	}

	// 페이지 이동
	function move($url = false){
		echo "<script>";
			echo $url ? "document.location.replace('{$url}')" : "history.back()";
		echo "</script>";
		exit;
	}

	// 엑세스
	function access($bool,$msg,$url = false){
		if(!$bool){
			alert($msg);
			move($url);
		}
	}

	// autoload
	function __autoload($className){
		switch($className){
			case 'Application' :
			case 'Controller' :
			case 'Model' :
				$classPath = CORE_PATH."/{$className}";
			break;
			default :
				$classPath = preg_replace("/(.*)(Controller|Model)/","$2",$className);
				$classPath = strtolower($classPath);
				$classPath = APP_PATH."/{$classPath}/{$className}";
			break;
		}
		include_once("{$classPath}.php");
	}

	// file upload
	function file_upload($file){
		$tmp_name = $file['tmp_name'];
		$com_name = $file['name'];
		if(is_uploaded_file($file['tmp_name'])){
			$ext = explode(".",$com_name);
			$ext = array_pop($ext);
			$change_name = time().rand(0,99999).".{$ext}";
			if(!move_uploaded_file($tmp_name,DATA_PATH."/{$change_name}")){
				echo "<pre>";
				print_r($file);
				echo "</pre>";
				exit;
			}
			return $change_name;
		}
		return null;
	}

	// mega byte
	function get_mb($size){
		$size /= 1024*1024;
		if($size>1)
			$size = number_format($size);
		else
			$size = floor($size*1000)/1000;
		return $size . " MB";
	}