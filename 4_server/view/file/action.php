<?php
extract($_POST);
$add_sql = "";
$msg = "완료되었습니다.";
$url = HOME_URL."/file";
switch($action){
	case 'dir_add' :
		$sql = "SELECT * FROM files where com_name = '{$com_name}' and parent='{$path}';";
		access(rowCount($sql) == 0,"같은 디렉토리에 중복된 이름이 있습니다.");
		$sql = "
			INSERT INTO files SET
			parent='{$path}',
			midx='{$member->idx}',
			com_name='{$com_name}',
			create_date=now(),
			change_date=now(),
			type='path';
		";
		$url .= "?path={$path}";
	break;
	case 'update' : 
		if(isset($ext)){
			$com_name .= $ext;
		}
		$sql = "
			UPDATE files SET
			com_name = '{$com_name}',
			change_date = now()
			where idx='{$idx}';
		";
	break;
	case 'file_upload' :
		$file = $_FILES['file'];
		access(is_uploaded_file($file['tmp_name']),"업로드된 파일이 없습니다.");
		$change_name = file_upload($file);
		$sql = "
			INSERT INTO files SET
			com_name='{$file['name']}',
			midx='{$member->idx}',
			change_name='{$change_name}',
			create_date=now(),
			change_date=now(),
			parent='{$path}',
			type='file',
			size='{$file['size']}';
		";
		$url = false;
	break;
}
$res = query($sql);
if($res){
	alert($msg);
	move($url);
}