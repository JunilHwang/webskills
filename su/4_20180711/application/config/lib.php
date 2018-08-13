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

// Get Extension Name
function getExt ($name) {
	$ext = preg_replace("/(.*)\.(.*)/", "$2", $name);
	return strtolower($ext);
}

// file upload
function fileUpload ($tbl, $idx, $file, $model, $update = false) {
	if (is_uploaded_file($file['tmp_name'])) {
		$model->execArr = [];
		if ($update) {
			$model->query("DELETE FROM {$model->table->file} where tbl = '{$tbl}' and idx = '{$idx}'");
			@unlink(_UPDIR."/{$_POST['beforeFile']}");
		}
		$ext = getExt($file['name']);
		$origin = $file['name'];
		$saved = time().'_'.rand(0,99999).'.'.$ext;
		access(in_array($ext, ['jpg', 'jpeg', 'png', 'gif']), "이미지 파일만 업로드할 수 있습니다.");
		$uri = UP_URL."/{$saved}";
		if (move_uploaded_file($file['tmp_name'], _UPDIR."/{$saved}")) {
			$model->sql = "
				INSERT INTO {$model->table->file} SET
				`tbl`    = '{$tbl}',
				`idx`    = '{$idx}',
				`origin` = '{$origin}',
				`saved`  = '{$saved}',
				`date`   = now(),
				`uri`    = '{$uri}';
			";
			$model->query();
		}
	}
}

// short content
function shortContent ($str, $len) {
	$str = strip_tags($str);
	if (strlen($str) > $len)
		$str = mb_substr($str, 0, $len, 'UTF-8')." ... [더보기]";
	return $str;
}

// Class Include
function __autoload($className){
	$className2 = strtolower($className);
	$bool = strpos($className2, "controller") || strpos($className2, "model");
	if (!in_array($className2, ['controller', 'model']) && $bool) {
		$path = strpos($className2,"controller") ? _CONTROLLER : _MODEL;
		$path .= "/{$className}.php";
	} else {
		$path = _CORE."/{$className}.php";
	}
	include_once($path);
}

// pagination
function pagination ($url, $page_num, $line, $total) {
	$last = ceil($total / $line);
	$url = explode('{{num}}', $url);
	$prev_num = $page_num - 1;
	$next_num = $page_num + 1;
	if ($prev_num < 1) $prev_num = 1;
	if ($next_num > $last) $next_num = $last;
	$prev_link = $url[0].$prev_num.$url[1];
	$next_link = $url[0].$next_num.$url[1];
    $str = '<li class="waves-effect"><a href="'.$prev_link.'"><i class="material-icons">chevron_left</i></a></li>';
	for ($i = 1; $i <= $last; $i++) {
		$link = $url[0].$i.$url[1];
		$active = $i == $page_num ? ' active' : '';
		$str .= '<li class="waves-effect'.$active.'"><a href="'.$link.'">'.$i.'</a></li>';
	}
    $str .= '<li class="waves-effect"><a href="'.$next_link.'"><i class="material-icons">chevron_right</i></a></li>';
    return "<ul class=\"pagination center\">{$str}</ul>";
}