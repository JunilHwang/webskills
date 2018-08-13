<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>웹 하드</title>
</head>
<body>
	<?php if ($is_member): ?>
	<?php if ($member->level == 10): ?>
	<a href="<?php echo HOME_URL?>/member/list">회원관리</a>
	<?php endif ?>
	<a href="<?php echo HOME_URL?>/login/logout">로그아웃</a>
	<?php endif ?>
	<a href="<?php echo HOME_URL?>/file">웹하드</a>
	<a href="<?php echo HOME_URL?>/share/in_list">내부 공유 리스트</a>
	<a href="<?php echo HOME_URL?>/share/out_list">외부 공유 목록</a>