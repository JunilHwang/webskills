<?php
$idxs = $parent = [];
$list = fetchAll("SELECT idx FROM files where parent='{$idx}'");

foreach($list as $data)
	$parent[] = $data->idx;

$idxs = $parent;
while(isset($parent[0])){
	$parent = implode(",",$parent);
	$child_list = fetchAll("SELECT idx FROM files where parent in ($parent)");
	$parent = [];
	foreach($child_list as $data){
		$idxs[] = $data->idx;
		$parent[] = $data->idx;
	}
}
$idxs[] = $idx;
$idxs = implode(",",$idxs);
$file_list = fetchAll("SELECT * FROM files where idx in ({$idxs}) and type != 'path';");

foreach($file_list as $data)
	@unlink(DATA_PATH."/{$data->change_name}");

$sql = "DELETE FROM files where idx in ({$idxs})";
query($sql);
alert("삭제 되었습니다.");
move();