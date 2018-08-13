<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo isset($site_title) ? $site_title : $param->site_title ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo SRC_URL?>/materialize/css/materialize.css">
<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL?>/nanumbarungothic.css">
<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL?>/common.css">
<script type="text/javascript" src="<?php echo JS_URL?>/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo SRC_URL?>/materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="<?php echo JS_URL?>/common.js"></script>
</head>
<body>
<!-- site header -->
<header class="site-header">
    <!-- utli menu -->
    <div class="header-top">
        <div class="container">
            <ul>
                <?php if(!$param->isMember) { ?>
                <li><a href="<?php echo HOME_URL?>/member/login" class="layerOpener">로그인</a></li>
                <li><a href="<?php echo HOME_URL?>/member/register" class="layerOpener">회원가입</a></li>
                <?php } else {?>
                <li><a href="<?php echo HOME_URL?>/member/logout">로그아웃</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="header-content container" role="navigation">
        <!-- logo -->
        <h3 class="logo"><a href="<?php echo HOME_URL?>"><img src="<?php echo IMG_URL?>/logo.png" alt="아름다운 여수, 행복한 시민"></a></h3>

        <!-- global navigation bar  -->
        <ul class="gnb">
            <li<?php echo "{$param->type}/{$param->action}" == 'tour/list' ? ' class="active"' : '' ?>>
                <a href="<?php echo HOME_URL?>/tour/list">관광지 정보</a>
            </li>
            <li<?php echo "{$param->type}/{$param->action}" == 'course/list' ? ' class="active"' : '' ?>>
                <a href="<?php echo HOME_URL?>/course/list">추천 코스 여행</a>
            </li>
            <li<?php echo "{$param->type}/{$param->action}" == 'review/list' ? ' class="active"' : '' ?>>
                <a href="<?php echo HOME_URL?>/review/list">관광지 리뷰</a>
            </li>
        </ul>
    </div>
</header>

<!-- site content -->
<section class="site-content">

    <!-- visual area -->
    <section class="visual<?php echo $param->isSub ? ' sub' : '' ?>">
        <h3><img src="<?php echo IMG_URL?>/txt-slogan.png" alt="해양 관광 휴양 도시, 생명의 푸르름 가득한 여수"></h3>
    </section>

    <!-- main content -->
    <section class="content-wrap container">