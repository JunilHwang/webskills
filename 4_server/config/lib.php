<?php

	//db method
	function query($sql){
		$db = new PDO("mysql:host=127.0.0.1;dbname=0320;charset=utf8","root","nif");
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
		if($res = $db->query($sql)){
			return $res;
		} else {
			echo $sql;
			echo "<pre>";
			print_r($db->errorInfo());
			echo "</pre>";
			exit;
		}
	}

	function fetch($sql){
		return query($sql)->fetch();
	}

	function rowCount($sql){
		return query($sql)->rowCount();
	}

	function fetchAll($sql){
		return query($sql)->fetchAll();
	}

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

	// out share
	function outShare(){
		query("UPDATE outfile_list SET cnt=cnt+1 where ukey='{$_GET['q']}'");
		$data = fetch("
			SELECT  o.*,
					m.name as member_name,
					m.id as member_id,
					f.com_name as file_name,
					f.change_name as change_name,
					f.size as file_size
			FROM 	outfile_list o
			join 	member m on o.midx = m.idx
			join 	files f on o.fidx = f.idx
			where o.ukey='{$_GET['q']}'
		");
		
		$path = DATA_PATH."/{$data->change_name}";
		header("Pragma: public");
		header("Expires: 0");
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"{$data->file_name}\"");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: {$data->file_size}");
		ob_clean();
		flush();
		readfile($path);
		exit;
	}

	//getPathName
	function getRouteName(){
		$path = isset($_GET['path']) ? $_GET['path'] : 0;
		$root = '<a href="'.HOME_URL.'/file">root</a>';
		$path_name = $root;
		if($path == 0){
			return $path_name;
		} else {
			$data = fetch("SELECT * FROM files where type='path' and idx = '{$path}'");
			$path_name = $data->com_name;
			while($data){
				$data = fetch("SELECT * FROM files where type='path' and idx = '{$data->parent}'");
				if($data){
					$link = HOME_URL."/file?path={$data->idx}";
					$path_name = "<a href=\"{$link}\">{$data->com_name}<a/> &gt; {$path_name}";
				}
			}
			return "{$root} &gt; {$path_name}";
		}
	}