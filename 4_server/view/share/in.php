<?php
$fidx = $idx;
$midx = $member->idx;
$sql = "
	INSERT INTO infile_list SET
	fidx = '{$fidx}',
	midx = '{$midx}',
	regdate = now();
";
query($sql);
alert('공유되었습니다.');
move();