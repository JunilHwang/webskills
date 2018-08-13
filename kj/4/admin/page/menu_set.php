<?php
    include_once("{$_SERVER['DOCUMENT_ROOT']}/include/lib.php");

    if($_SESSION['userid'] != 'root'){
        msgMove('관리자만 접근가능합니다.', '../login.php');
    }

    $pdo->query("delete from menu_set where s_ok='0'");
?>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>홈페이지 메뉴 설정</title>

    <!-- DEFAULT CSS -->
    <link rel="stylesheet" type="text/css" href="/css/default.css">

    <!-- ADMIN CSS -->
    <link rel="stylesheet" type="text/css" href="/admin/css/admin.css">

    <script type="text/javascript" src="/js/jquery.min.js"></script>

    <script type="text/javascript" src="/js/jquery-ui.js"></script>

    <!-- SCRIPT -->
    <script type="text/javascript" src="/js/script.js"></script>

    <style type="text/css">
        .menu-set {
            float: left;
            width: 100%;
        }

        .menu-set .page-title {
            float: left;
            width: 100%;
            margin: 30px 0 50px;
        }

        .menu-set .menu-set-area {
            float: left;
            width: 100%;
        }

        .menu-set .menu-set-area .menu-set-list {
            float: left;
            width: 100%;
        }

        .menu-set .menu-set-area .menu-set-list>ul {
            float: left;
            width: 100%;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li {
            float: left;
            width: 100%;
            border-radius: 5px;
            background-color: #eee;
            padding: 15px 25px;
            border: 1px solid #cfcfcf;
            margin-bottom: 20px;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li>.box-area {
            float: left;
            width: 100%;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area {
            float: left;
            width: 100%;
            margin-left: 10px;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area .menu_parent_title {
            display: inline-block;
            width: 130px;
            height: 27px;
            color: #222;
            border: 1px solid #bba886;
            padding-left: 3px;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area .menu-num {
            display: inline-block;
            vertical-align: middle;
            font-size: 13px;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area #menu_switch {
            display: inline-block;
            width: 80px;
            height: 27px;
            background-color: #efefef;
            border: 1px solid #aaa;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area .two_menu_add {
            display: inline-block;
            padding: 0 8px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            height: 27px;
            line-height: 27px;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area .parent-menu-remove {
            display: inline-block;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area .parent-menu-remove span {
            font-size: 13px;
            color: #444;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area>* {
            margin-right: 13px;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-child-box {
            float: left;
            width: 100%;
            margin-top: 10px;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-child-box>ul>li {
            float: left;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #fff;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-fot-control {
            float: right;
            margin-top: 10px;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-fot-control button {
            padding: 8px 15px;
            margin-left: 10px;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-fot-control .menu-add-btn {
            background-color: #333;
            color: #fff;
            border: 1px dotted #376c8b;
            border-radius: 3px;
        }

        .menu-set .menu-set-area .menu-set-list>ul>li .menu-fot-control .menu-remove-btn {
            background-color: #333;
            color: #fff;
            border: 1px dotted #376c8b;
            border-radius: 3px;
        }

        /*하위 메뉴*/

        .menu-child-box {
            float: left;
            width: 100%;
        }

        .menu-child-box>ul>li {
            float: left;
            width: 100%;
        }

        .menu-child-box>ul>.two-menu {
            float: left;
            width: 100%;
        }

        .menu-child-box>ul>.two-menu>* {
            display: inline-block;
            margin-right: 13px;
        }

        .menu-child-box>ul>.two-menu>input {
            width: 130px;
            height: 27px;
            color: #222;        
            border: 1px solid #bba886;
            padding-left: 3px;
        }

        .menu-child-box>ul>.two-menu>#menu_switch {
            width: 80px;
            height: 27px;
            background-color: #efefef;
            border: 1px solid #aaa;
        }

        .menu-child-box>ul>.two-menu>.menu-num {
            font-size: 13px;
        }

        .menu-child-box>ul>.two-menu>.menu-title {
            float: left;
        }

        .menu-child-box>ul>.two-menu>.thrid_menu_add {
            padding: 0 8px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            height: 27px;
            line-height: 27px;
        }

        .menu-child-box>ul>.two-menu>.parent-menu-remove span {
            font-size: 13px;
            color: #444;
        }

        /*3단 메뉴*/

        .thrid-menu {
            float: left;
            width: 100%;
        }

        .thrid-menu>li {
            float: left;
            width: 100%;
            background-color: #eee;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #cfcfcf;
            border-radius: 5px;
        }

        .thrid-menu>li>* {
            display: inline-block;
            margin-right: 13px;
        }

        .thrid-menu>li>h4 {
            font-size: 13px;
        }

        .thrid-menu>li>select {
            width: 80px;
            height: 27px;
            background-color: #efefef;
            border: 1px solid #aaa;
        }

        .thrid-menu>li>input {
            width: 130px;
            height: 27px;
            color: #222;
            background-color: #e1d6c2;
            border: 1px solid #bba886;
            padding-left: 3px;
        }

        .thrid-menu>li>.parent-menu-remove span {
            font-size: 13px;
            color: #444;
        }

        /*새로운 메뉴 추가 폼*/

        .menu-set .menu-set-area {
            float: left;
            width: 100%;
            border-radius: 3px;
        }

        .menu-set .menu-set-area form {
            float: left;
            margin-bottom: 10px;
        }

        .menu-set .menu-set-area .menu-add-frm {
            float: right;
            margin-bottom:20px;
        }

        .menu-set .menu-set-area .menu-add-frm .frm-inp {
            float: left;
        }

        .menu-set .menu-set-area .menu-add-frm .frm-inp>label {
            float: left;
            line-height: 30px;
            font-size: 14px;
            margin-right: 10px;
        }

        .menu-set .menu-set-area .menu-add-frm .frm-inp>input {
            float: left;
            padding: 0 10px;
            height: 30px;
            border: 1px solid #25404f;
            background-color: #fafafa;
        }

        .menu-set .menu-set-area .menu-add-frm .menu-control-btn {
            float: left;
            margin-left: 10px;
        }

        .menu-set .menu-set-area .menu-add-frm .menu-control-btn>button {
            float: left;
            padding: 7px 13px;
            margin-right: 10px;
            border-radius: 2px;
            background-color: #333;
            color: #fff;
        }
    </style>

</head>

<body>
    <div id="wrap" class="admin">
        <?php
            include_once("../header.php");
        ?>

        <!-- AD_CONTENTS -->
        <div id="contents">
            <div class="menu-set">
                <div class="wrap">
                    <div class="page-title">
                        <h3>메뉴관리</h3>
                    </div>

                    <div class="menu-set-area">
                        <div class="menu-add-frm">
                            <div class="menu-control-btn">
                                <button type="button" class="menu-add-btn">추가</button>
                            </div>
                        </div>

                        <form method="post" id="menu-modify-frm">
                            <div class="menu-set-list">
                                <ul>
                                    <?php
                                        $list = $pdo->query("select * from menu_set where m_dan='1' order by l_order asc");
                                        while($list_r = $list->fetch(2)){
                                    ?>
                                    <!-- 1차 메뉴 -->
                                    <li class="parent-menu-list" >
                                        <input type="hidden" name="first_menu_idx[]" value="<?= $list_r['idx'] ?>" >
                                        <div class="box-area">
                                            <div class="menu-parent-area">
                                                <h4 class="menu-num">1차 메뉴</h4>
                                                <input type="text" name="first_menu_title[]" value="<?= $list_r['name'] ?>" class="menu_parent_title">

                                                <select name="menu1_switch[]" id="menu_switch">
													<option value="1" <?= $list_r['m_active'] == '1' ? 'selected' : '' ?>>사용</option>
													
													<option value="0" <?= $list_r['m_active'] == '0' ? 'selected' : '' ?> >사용 안함</option>
												</select>

                                                <button type="button" class="two_menu_add" data-idx="<?= $list_r['idx'] ?>">+ 2차 메뉴 추가</button>

                                                <div class="parent-menu-remove">
                                                    <input type="checkbox" name="parent_menu_remove[]" value="<?= $list_r['idx'] ?>">
                                                    <span>이 메뉴와 하위 메뉴를 삭제</span>
                                                </div>
                                            </div>

                                            <!-- 하위 메뉴 리스트 -->
                                            <div class="menu-child-box">
                                                <!-- 2차 메뉴 -->
                                                <ul class="two-menu-wrap">
                                                    <?php
                                                        $list2 =  $pdo->query("select * from menu_set where m_dan='2' and parent_idx='{$list_r['idx']}' order by l_order asc");
                                                        while($list_r2 = $list2->fetch(2)){
                                                    ?>
                                                    <li class="two-menu" >
                                                        <input type="hidden" name="two_menu_idx[]" value="<?= $list_r2['idx'] ?>" >
                                                        <h4 class="menu-num">2차 메뉴</h4>
                                                        <input type="text" name="two_menu_title[]" value="<?= $list_r2['name'] ?>" class="two_menu_title">

                                                        <select name="menu2_switch[]" id="menu_switch">
															<option value="1" <?= $list_r2['m_active'] == '1' ? 'selected' : '' ?>>사용</option>
													
													        <option value="0" <?= $list_r2['m_active'] == '0' ? 'selected' : '' ?> >사용 안함</option>
														</select>

                                                        <div class="parent-menu-remove">
                                                            <input type="checkbox" name="parent_menu_remove[]" value="<?= $list_r2['idx'] ?>">
                                                            <span>이 메뉴와 하위 메뉴를 삭제</span>
                                                        </div>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>

                                            <div class="menu-fot-control">
                                                <button type="button" class="menu-remove-btn">전체 삭제</button>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </form>

                        <div class="menu-set-btn">
                            <button type="button" class="menu-save-btn">변경사항 적용하기</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="footer">
            <div class="copy">
                <p>COPYRIGHT (c) 2018 ALL RIGHTS RESERVED.</p>
            </div>        
        </div>
    </div>
    
    <script>
        $(function(){
            $('.menu-set-list > ul').sortable();
		$('.two-menu-wrap').sortable();
            $('body').on('click', '.menu-add-btn', function(e){
                $.ajax({
                    type : "POST",
                    url : "/ajax/menu-add-ok.php",
                    success : function(data){
                        if(!data){
                            alert('메뉴는 5개까지 설정 가능합니다.');
                        } else {
                            var html = '<li class="parent-menu-list" >';
                                html += '<input type="hidden" name="first_menu_idx" value="'+data+'" >';
                                html += '<div class="box-area">';
                                    html += '<div class="menu-parent-area">';
                                        html += '<h4 class="menu-num">1차 메뉴</h4>';
                                        html += '<input type="text" name="first_menu_title[]" class="menu_parent_title">';
                                        html += '<select name="menu1_switch[]" id="menu_switch">';
                                            html += '<option value="on" selected="">사용</option>';
                                            html += '<option value="off">사용 안함</option>';
                                        html += '</select>';
                                        html += '<button type="button" class="two_menu_add">+ 2차 메뉴 추가</button>';
                                        html += '<div class="parent-menu-remove">';
                                            html += '<input type="checkbox" name="parent_menu_remove" >';
                                            html += '<span>이 메뉴와 하위 메뉴를 삭제</span>';
                                        html += '</div>';
                                    html += '</div>';
                                    html += '<!-- 하위 메뉴 리스트 -->';
                                    html += '<div class="menu-child-box">';
                                    html += '</div>';
                                    html += '<div class="menu-fot-control">';
                                        html += '<button type="button" class="menu-remove-btn">전체 삭제</button>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</li>';

                            $('.menu-set-list > ul').append(html);
                            
                        }
                    }
                })
                
            })
            
            $('body').on('click', '.two_menu_add', function(e){
                var el = $(this);
                var idx = $(this).attr('data-idx');
                
                $.ajax({
                    type : "POST",
                    url : "/ajax/two-menu-add-ok.php",
                    data : { idx : idx },
                    success : function(data){
                        var html = '<li class="two-menu" >';
                                        html += '<input type="hidden" name="two_menu_idx[]" value="'+data+'" >';
                                        html += '<h4 class="menu-num">2차 메뉴</h4>';
                                        html += '<input type="text" name="two_menu_title[]" value="" class="two_menu_title">';
                                        html += '<select name="menu2_switch[]" id="menu_switch">';
                                            html += '<option value="1" >사용</option>';
                                            html += '<option value="0" >사용 안함</option>';
                                        html += '</select>';
                                        html += '<div class="parent-menu-remove">';
                                            html += '<input type="checkbox" name="parent_menu_remove[]" value="">';
                                            html += '<span>이 메뉴와 하위 메뉴를 삭제</span>';
                                        html += '</div>';
                                    html += '</li>';

                        $(el).parents("li").find('.two-menu-wrap').append(html);
                    }
                })
            })
            
            $('body').on('click', '.menu-save-btn', function(e){
                var frm = $('#menu-modify-frm');
                
                $.ajax({
                    type : "POST",
                    url : "/ajax/menu-set-save.php",
                    data : $(frm).serialize(),
                    success : function(data){
                        alert('변경사항이 적용되었습니다.');
                        location.reload();
                    }
                })
            })
        })
    </script>
</body>

</html>