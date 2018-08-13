<?php
	if(isset($_GET['param'])){
		$param = explode('/',$_GET['param']);
	}
	$type = isset($param[0]) && $param[0] != '' ? $param[0] : 'client';
	$action = isset($param[1]) ? $param[1] : NULL;
	$idx = isset($param[2]) ? $param[2] : NULL;
	$page_num = isset($param[2]) ? $param[2] : 1;
	$include_file = isset($action) ? $action : $type;
	$menu = [
		'client'=>['title'=>'거래처관리','link'=>$base_url.'/client'],
		'product'=>['title'=>'제품관리','link'=>$base_url.'/product'],
		'in_pro'=>['title'=>'입고관리','link'=>$base_url.'/in_pro'],
		'out_pro'=>['title'=>'출고관리','link'=>$base_url.'/out_pro']
	];
?>