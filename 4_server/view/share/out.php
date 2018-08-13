<?php
	$fidx = $idx;
	$midx = $member->idx;
	$keycode = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
	$len = strlen($keycode);
	$ukey = "";
	while(1){
		$ukey = '';
		for($i=0;$i<4;$i++) $ukey .= $keycode[rand(0,$len-1)];
		if(preg_match("/([0-9]+)/",$ukey) == 0) continue;
		if(rowCount("SELECT ukey FROM outfile_list where ukey = '{$ukey}'")) continue;
		break;
	}
	$sql = "
		INSERT INTO outfile_list SET
		fidx = '{$fidx}',
		midx = '{$midx}',
		ukey = '{$ukey}',
		regdate = now();
	";
	query($sql);
	alert('공유되었습니다.');
	move();