<?php
    include_once("{$_SERVER['DOCUMENT_ROOT']}/include/lib.php");

    if($_SESSION['userid'] != 'root'){
        msgMove('관리자만 접근가능합니다.', '../login.php');
    }
?>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>관리자</title>
    
    <link rel="stylesheet" href="/css/default.css">
    
    <link rel="stylesheet" href="/admin/css/admin.css">
    
    <script src="/js/jquery.min.js"></script>
    
    <script type="text/javascript" src="/js/jquery-ui.js"></script>
    
    <script src="/js/script.js"></script>
</head>
<body>
    <style>
        .m-cont { float:left; width:100%; margin-top:10px; }
        .m-cont  > li { float:left; width:100%; background-color:#fff; border:1px solid #ccc; padding:15px 20px; margin-bottom:10px; }
        .m-cont  > li p { margin-top:3px; font-size:14px; }
        .m-cont  > li.add-list { background-color:#fff !important; }
    </style>
    <div id="wrap" class="admin">
        <?php
            include_once("../header.php");
        ?>

        <div id="contents" class="main-page">
            <div class="wrap">
                <div class="page-title">
                    <h3>메인페이지 구성</h3>
                </div>
                
                <div class="dan-add-btn">
                    <button type="button">단 추가</button>
                </div>
                
                <form method="post" class="main-page-frm" >
                    <div class="dan-list">
                        <div class="dan-add-frm">
                        </div>
                        
                        <?php
                            $list = $pdo->query("select * from main_page where parent_idx=0 order by l_order asc");
                            while($list_r = $list->fetch(2)){
                        ?>
                        <div class="list" >
                            <input type="hidden" id="m_page1" name="m_page1[]" value="<?= $list_r['idx'] ?>" >

                            <p>1단 : 상단 라인색 : 
                            <?php
                                if($list_r['t_line'] == ''){
                            ?>
                            미설정
                            <?php } else { ?>
                            <span class="prv-color" style="display:inline-block; vertical-align:middle;width:20px; height:20px; border:1px solid #ccc; background-color:<?= $list_r['t_line'] ?>"></span>, 
                            <?php } ?>
                            하단 라인색 : 
                            <?php
                                if($list_r['b_line'] == ''){
                            ?>
                            미설정
                            <?php } else { ?>
                            <span class="prv-color" style="display:inline-block; vertical-align:middle;width:20px; height:20px; border:1px solid #ccc; background-color:<?= $list_r['b_line'] ?>"></span>, 
                            <?php } ?>
                            배경색 : 
                            <?php
                                if($list_r['b_color'] == ''){
                            ?>
                            미설정
                            <?php } else { ?>
                            <span class="prv-color" style="display:inline-block; vertical-align:middle;width:20px; height:20px; border:1px solid #ccc; background-color:<?= $list_r['b_color'] ?>"></span></p>
                            <?php } ?>

                            <button type="button" class="main-page-set" onclick="window.open('/popup/main-page-color.php?idx=<?= $list_r['idx'] ?>', '', 'width=600, height=500');">라인 및 배경색 설정</button>

                            <button type="button" class="cont-add">+ 컨텐츠 추가</button>

                            <span>
                                <input type="checkbox" class="r_chk" name="remove-chk[]" value="<?= $list_r['idx'] ?>">
                                삭제
                            </span>

                            <ul class="m-cont">
                                <?php
                                    $list2 = $pdo->query("select * from main_page where parent_idx='{$list_r['idx']}' order by l_order asc");
                                    while($list_r2 = $list2->fetch(2)){
                                ?>
                                <li>
                                    <input type="hidden" id="m_page2" name="m_page2[]" value="<?= $list_r2['idx'] ?>">
                                    <p><span>↕</span> 컨텐츠 : 
                                    <?php
                                        if($list_r2['c_type'] == '0'){
                                    ?>
                                    미설정 
                                    <?php } else if($list_r2['c_type'] == '1'){ ?>
                                    게시판 - <?= $pdo->query("select * from board_set where idx='{$list_r2['b_idx']}'")->fetch(2)['name'] ?>
                                    <?php } else if($list_r2['c_type'] == '2'){ ?>
                                    배너 - <?= $list_r2['def_img'] ?>
                                    <?php } ?>
                                    </p>
                                    <button type="button" class="cont-set" onclick="window.open('/popup/main-page-cont-set.php?idx=<?= $list_r2['idx'] ?>', '', 'width=600, height=500');">컨텐츠 설정</button>
                                    <input type="checkbox" class="r_chk" name="remove-chk[]" value="<?= $list_r2['idx'] ?>" > 삭제
                                </li>
                                <?php } ?>
                            </ul>

                        </div>
                        <?php } ?>
                    </div>
                </form>
                
                <div class="save-btn">
                    <button type="button">변경사항 적용하기</button>
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
            $('.dan-list').sortable({
                calcen : '.dan-add-frm'
            })
            
            $('body').on('click', '.main-page .dan-add-btn button', function(e){
		$.ajax({
			type : "POST",
			url : "/ajax/main-page-add.php",
			success : function(data){
				location.reload();
			}
		});
                /*$('.dan-add-frm').append('<div class="add-list">\
                                            <p>단 : 생성 후 색상 설정 및 컨텐츠 추가가 가능합니다. (하단의 "변경사항 적용하기" 클릭하여 단 생성을 완료하세요.)</p>\
                                        </div>');*/
            })
            
            $('body').on('click', '.save-btn button', function(e){
                var list = $('.add-list');
                var frm = $('.main-page-frm');
                
                
                $.each(list, function(k, v){
                    $.ajax({
                        type : "POST",
                        async : false,
                        url : "/ajax/main-page-add.php",
                        success : function(data){
                            
                        }
                    })
                })
                
                $.ajax({
                    type : "POST",
                    async : false,
                    url : "/ajax/main-page-save.php",
                    data : $(frm).serialize(),
                    success : function(data){
                        
                    }
                })
                
                alert('변경사항이 적용되었습니다.');
                location.reload();
            })
            
            $('body').on('click', '.cont-add', function(e){
                var el = $(this);
                var idx = $(el).parents(".list").find("#m_page1").val();
                
                $.ajax({
                    type : "POST",
                    url : "/ajax/main-page-cont-add.php",
                    data : { idx : idx },
                    success : function(data){
                        var html = '<li>';
                            html += '<input type="hidden" name="page2-idx[]" value="'+data+'">';
                            html += '<p><span>↕</span> 컨텐츠 : 미설정 </p>';
                            html += '<button type="button" class="cont-set" onclick="window.open(\'/popup/main-page-cont-set.php?idx='+data+'\', \'\', \'width=600, height=500\');">컨텐츠 설정</button>';
                            html += '<input type="checkbox" class="r_chk" name="remove-chk[]" value="'+data+'" > 삭제';
                        html += '</li>';

                        $(el).parents(".list").find('.m-cont').append(html);
                    }
                })
            })
        })
    </script>
</body>
</html>