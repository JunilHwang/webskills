<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>관리자</title>

    <link rel="stylesheet" href="<?php echo CSS_URL?>/default.css">

    <link rel="stylesheet" href="<?php echo CSS_URL?>/admin.css">

    <script src="<?php echo JS_URL?>/jquery.min.js"></script>

    <script type="text/javascript" src="<?php echo JS_URL?>/jquery-ui.js"></script>

    <script src="<?php echo JS_URL?>/script.js"></script>
</head>

<body>
    <div id="wrap" class="admin">
        <div id="header">
            <div class="wrap">
                <div class="hd-top">
                    <div id="logo">
                        <h1><a href="<?php echo $param->get_page?>">ADMIN</a></h1>
                    </div>

                    <a href="<?php echo HOME_URL?>" class="home-move">홈페이지로 이동</a>
                    <?php if ($param->isMember): ?>
                    <p><a href="<?php echo $param->get_page.'/logout'?>">LOG OUT</a></p>
                    <?php else: ?>
                    <p><a href="<?php echo $param->get_page.'/login'?>">LOG IN</a></p>
                    <?php endif ?>
                </div>

                <div class="hd-bot">
                    <ul>
                        <li>
                            <a href="#">관리 메뉴</a>
                        </li>
                    </ul>

                    <div class="submenu"<?php echo $param->menu_toggle ? '' : ' style="display:none;"' ?>>
                        <ul>
                            <li><a href="<?php echo $param->get_page.'/menu_set'?>">홈페이지 관리</a></li>
                            <li><a href="<?php echo $param->get_page.'/menu_set'?>">메뉴관리</a></li>
                            <li><a href="<?php echo $param->get_page.'/main_page'?>">메인페이지 구성</a></li>
                            <li><a href="<?php echo $param->get_page.'/menu_contents'?>">메뉴별컨텐츠</a></li>
                            <li><a href="<?php echo $param->get_page.'/main_image_design'?>">애니메이션 구성</a></li>
                        </ul>

                        <ul>
                            <li><a href="<?php echo $param->get_page.'/board_set';?>">게시판</a></li>
                            <li><a href="<?php echo $param->get_page.'/board_set';?>">설정</a></li>
                        </ul>

                        <span><a href="<?php echo $param->get_page?>/menu_toggle?back=<?php echo $_GET['param']?>"><?php echo $param->menu_toggle ? '메뉴 접기' : '메뉴 열어두기'?></a></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrap" class="admin">
            <div id="header">
            </div>