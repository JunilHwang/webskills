<?php
	

// alert
function alert ($str) {
	echo "<script>alert('{$str}')</script>";
}

// move
function move ($str = false) {
	echo "<script>";
	echo $str ? "location.replace('{$str}')" : "history.back();";
	echo "</script>";
	exit;
}

// access
function access ($bool, $msg, $url = false) {
	if (!$bool) {
		alert($msg);
		move($url);
	}
}

// access_echo
function access_echo ($bool, $msg, $url = false) {
	if (!$bool) {
		println($msg);
		//move($url);
		exit;
	}
}

// println
function println ($str) {
	echo "<p>{$str}</p>";
}

// print_r2
function print_pre ($str, $bool = true) {
	echo "<pre>";
		print_r($str);
	echo "</pre>";
	if($bool) exit;
}

// get uri
function getURI ($path) {
	$uri = str_replace(_ROOT, "", $path);
	return $uri;
}

// Get Only File name
function getOnlyFileNmae ($name) {
	$onlyFileName = preg_replace("/(.*)\.(.*)/", "$1", $name);
	return $onlyFileName;
}

// zip directory create
function dirZip ($zip, $dir, $removePath) {
    clearstatcache();
    $full = _ROOT.$dir;
    $fp = @opendir($full);
    while (false !== ($name = readdir($fp))) {
        if (in_array($name, ['..', '.', ''])) continue;
    	$fullPath = "{$full}/{$name}";
    	$savedPath = str_replace($removePath, "", "{$dir}/{$name}");
    	println($savedPath);
    	//println($savedPath);
        if (filetype($fullPath) === 'dir') {
            clearstatcache();
            // 디렉토리이면 생성하기
            $zip->addEmptyDir($savedPath);
            set_time_limit(0);
            dirZip($zip, "{$dir}/{$name}", $removePath);
        } else {
            // 파일이면 파일 압축하기 
            $zip->addFile($fullPath, $savedPath);
        }
    }
    if (is_resource($fp)) {
        closedir($fp);
    }
}

// zip create
function zipCreate ($dir, $zipName, $removePath) {
	$zip = new ZipArchive();
	$res = $zip->open($zipName, ZipArchive::CREATE);
    dirZip($zip, $dir, $removePath);
    $zip->close();
    header("Content-Type: application/octet-stream");
	header('Content-Length: ' . filesize($zipName));
	header("Content-Transfer-Encoding: binary");
	header('Content-Disposition: attachment; filename='.basename($zipName));
	ob_clean();
	flush();
	readfile($zipName);
	unlink($zipName); 
	exit;
}

// uriToPath
function fileToCode ($path) {
	$ext_chk = isImagePath($path);
	if ($ext_chk) {
		$src = URL.str_replace(_ROOT, "", $path);
		$rand = rand(0,99999);
		$content = "<img src=\"{$src}?rand={$rand}\" alt=\"{$src}\" style=\"max-width:100%;\">";
	} else {
		$content = file_get_contents($path);
		$content = toCode($content);
	}
	return $content;
}

// toCode
function toCode ($content) {
	$content = htmlspecialchars($content);
	$content = str_replace(" ", " ", $content);
	$content = str_replace("	", "&nbsp;&nbsp;&nbsp;&nbsp;", $content);
	$content = nl2br($content);
	return $content;
}

// Get Extension Name
function getExt ($name) {
	$ext = preg_replace("/(.*)\.(.*)/", "$2", $name);
	return strtolower($ext);
}

// ext chk
function isImagePath ($path) {
	$ext = preg_replace("/(.*)\/(.*)/", "$2", mime_content_type($path));
	$ext_arr = ['jpg','jpeg','png'];
	return in_array($ext, $ext_arr);
}

// copy directory
function copyDir($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ($name = readdir($dir)) ) { 
    	if (in_array($name, ['.', '..', ''])) continue;
    	$filePath  = "{$src}/{$name}";
    	$dstPath  = "{$dst}/{$name}";
        is_dir($filePath) ? copyDir($filePath,$dstPath)
            			  : copy($filePath,$dstPath);
    } 
    closedir($dir); 
} 

// Class Include
function __autoload($className){
	$className2 = strtolower($className);
	switch ($className2) {
		case 'application' :
		case 'model' :
		case 'controller' :
		case 'param' :
		case 'diff' :
			$path = _CORE."/{$className}.php";
		break;
		default :
			if (strpos($className2,"controller")) {
				$path = _CONTROLLER;
			}
			else if (strpos($className2,"model")) {
				$path = _MODEL;
			}
			$path .= "/{$className}.php";
		break;
	}
	include_once($path);
}