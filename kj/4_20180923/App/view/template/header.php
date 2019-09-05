<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>전남관광명소</title>

    <link rel="stylesheet" href="<?php echo CSS_URL?>/default.css">

    <link rel="stylesheet" href="<?php echo CSS_URL?>/common.css">

    <?php if ($param->include_file !== 'page') { ?>
    <link rel="stylesheet" href="<?php echo CSS_URL?>/board.css">
    <?php } ?>

    <script src="<?php echo JS_URL?>/jquery.min.js"></script>

    <script src="<?php echo JS_URL?>/script.js"></script>
</head>

<body>
    <div id="wrap">
        <div id="header" class="main-header">
            <div class="wrap">
                <div id="logo">
                    <h1><a href="<?php echo HOME_URL.'/'?>">전남관광명소</a></h1>
                </div>

                <div id="util-menu">
                    <ul>
                        <li><a>홈</a></li>
                        <li><a href="#">E-mail : tour@yeosu.com</a></li>
                        <li><a href="#">Contents</a></li>
                        <?php if($param->isMember){ ?>
                        <li><button type="button" onclick="location.href = '<?php echo HOME_URL.'/admin'?>'; return false;">관리자모드</button></li>
                        <?php } else { ?>
                        <li><button type="button" onclick="location.href = '<?php echo HOME_URL.'/admin/login'?>'; return false;">관리자모드</button></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div id="main-menu" class="main-hd">
                <div class="wrap">
                    <ul class="menu">
                        <?php foreach ($main_menu as $main): ?>
                        <?php $link = $main->bidx == 0 ? HOME_URL."/page/menu/{$main->idx}" : HOME_URL."/board/list/1?bsidx={$main->bidx}" ?>
                        <li><a href="<?php echo $link?>"><?php echo $main->title?></a>
                            <ul>
                                <?php foreach ($sub_menu[$main->idx] as $i=>$sub): ?>
                                <?php $link = $sub->bidx == 0 ? HOME_URL."/page/menu/{$sub->idx}" : HOME_URL."/board/list/1?bsidx={$sub->bidx}" ?>
                                <li><a href="<?php echo $link?>"><?php echo $sub->title?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>