<?php
    include_once("include/lib.php");
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <title>전남관광명소</title>

        <link rel="stylesheet" href="/css/default.css">

        <link rel="stylesheet" href="/css/common.css">

        <script src="/js/jquery.min.js"></script>

        <script src="/js/script.js"></script>
    </head>

    <body>
        <div id="wrap">
            <?php
                include_once("include/header.php");
            ?>

            <div id="contents">
                <div class="banner">
                    <div class="banner-img">
			<?php
				$ba = $pdo->query("select * from main_image where l_back!=''")->fetch(2);
			?>
                        <div class="left-back" style="<?= $ba['l_back'] == '' ? 'background-color:#fff;' : 'background-color:#'.$ba['l_back'].';' ?>"></div>
                        <ul style="width: 100%; margin-left: 0%;">
                            <?php
                                $list = $pdo->query("select * from main_image where m_img!=''");
                                while($list_r = $list->fetch(2)){
                            ?>
                            <li class="anishow" style="width: 100%;">
                                <a href="#" >
                                    <div class="main-img" style="background-image:url('/upload/<?= $list_r['m_img'] ?>')"></div>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
			<div class="right-back" style="<?= $ba['r_back'] == '' ? 'background-color:#fff;' : 'background-color:#'.$ba['r_back'].';' ?>"></div>
			<div class="banner-pos">
				<ul>
					
				</ul>
			</div>
                    </div>
                </div>


                <div id="section">
                    <div class="wrap">
                        <?php
                            $list = $pdo->query("select * from main_page where parent_idx='0'");
                            while($list_r = $list->fetch(2)){
                        ?>
                        <div class="section" style="border-top:1px solid <?= $list_r['t_line'] ?>; border-bottom:1px solid <?= $list_r['b_line'] ?>; background-color:<?= $list_r['b_color'] ?>;">
                            <?php
                                $list2 = $pdo->query("select * from main_page where parent_idx='{$list_r['idx']}'");
                                $l_row = $list2->rowCount();
                                
                                while($list_r2 = $list2->fetch(2)){
                                    $width = 100 / $l_row;
                                    if($list_r2['c_type'] == '1'){
                                        $bds = $pdo->query("select * from board_set where idx='{$list_r2['b_idx']}'")->fetch(2);
                                        $bd = $pdo->query("select * from board where bds_idx='{$list_r2['b_idx']}'");
                                        
                                        if($bds['type'] == '1'){
                            ?>
                            <div class="board_cont" style="width:<?= $width ?>%;">
                                <div class="title">
                                    <h3 style="cursor:pointer;"><?= $bds['name'] ?></h3>
                                </div>

                                <ul>
                                    <?php
                                        while($bd_r = $bd->fetch(2)){
                                    ?>    
                                    <li><a href="#"><?= $bd_r['title'] ?> <span><?= explode(" ", $bd_r['datetime'])[0] ?></span></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <?php } else if($bds['type'] == '2'){ ?>

                            <div class="b_board" style="width:<?= $width ?>%;" >
                               <div class="title">
                                    <h3 onclick="link('/page/bd-list.php?bds_idx=');" style="cursor:pointer;"><?= $bds['name'] ?></h3>
                                </div>
                                <ul>
                                    <?php
                                        while($bd_r = $bd->fetch(2)){
                                            
                                    ?>
                                    <li onclick="link('/page/bd-view.php?idx=<?= $bd_r['idx'] ?>');">
                                        <h4 style="margin-right:10px;"></h4>
                                        <span class="img-area">
                                            <img src="/upload/" alt="">
                                        </span>

                                        <span class="no-img">
                                            No Image
                                        </span>

                                        <div class="l-info">

                                            <h3>게시판 제목</h3>
                                            <h5>게시판 날짜</h5>
                                            <p>게시판 내용</p>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <?php } else if($bds['type'] == '3'){ ?>

                           <div class="c_board" style="width:<?= $width ?>%;">
                               <div class="title">
                                    <h3 onclick="link('/page/bd-list.php?bds_idx=');" style="cursor:pointer;"></h3>
                                </div>
                                <ul>
                                    <li style="width:33.33%;" onclick="link('/page/bd-view.php?idx=');" >
                                        <div class="box">
                                            <div class="img" style="background-image:url('/upload/');">
                                            </div>

                                            <div class="no-image img" >
                                                <p>No Image</p>
                                            </div>

                                            <input type="checkbox" name="list-chk"  >
                                            <span class="b-no">게시판 번호</span>

                                            <h3>게시글 제목</h3>

                                            <p class="bd-from">작성자</p>

                                            <ul>
                                                <li>일시 <span></span></li>
                                                <li>조회 <span></span></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <?php } ?>
                            
                            <?php } else if($list_r2['c_type'] == '2'){ ?>
                            <div class="banner-img" style="width:<?= $width ?>%;">
                                <img src="/upload/<?= $list_r2['def_img'] ?>" alt="" <?= $list_r2['l_url'] == '' ? '' : 'onclick="link(\''.$list_r2['l_url'].'\')" style="cursor:pointer;"' ?> class="def_i" >
                                
                                <img src="/upload/<?= $list_r2['over_img'] ?>" alt="" class="over_i" style="display:none;">
                            </div>
                            <?php } ?>
                        <?php } ?>
                        </div>
                        
                        
                        <?php } ?>
                    </div>
                </div>
                <div class="wrap">

                </div>
            </div>

            <div id="footer">
                <div class="wrap">
                    <ul>
                        <li>상호 : 전남 관광</li>
                        <li>주소 : 전라남도 전남시 전남군</li>
                        <li><span>전화 : 010-1234-1234</span></li>
                        <li>Copyright © 2018전남관광. All Rights Reserved.</li>
                    </ul>
                </div>
            </div>
        </div>
        <script>
        $(function(){
		for(var i = 0; i < $(".banner-img > ul > li").length; i ++){
			$(".banner-pos > ul").append("<li></li>");
		}

		$(".banner-pos > ul li").eq(0).css({"background-color" : "#fff"});

//            애니메이션
                var b_len = $('.banner-img > ul > li').length;

                var all_wd = 100 * b_len;
                var one_wd = 100 / b_len;

                $('.banner-img > ul').css({"width" : all_wd+"%"});
                $('.banner-img > ul > li').css({"width" : one_wd+"%"});
                $('.banner-img > ul > li').eq(0).addClass('anishow');
                $('.banner-img > ul').attr('data-type', 'next');

                 var btn = {
                    on : function(){
                        this.timer = setInterval(function(){
                                animation('next');
                        }, <?= $pdo->query("select * from image_ani")->fetch(2)['second'] ?>000);
                    },
                    off : function(){
                        clearInterval(this.timer);
                    }
                 }

                btn.on();

//                $('body').on('mouseover', '.banner-img .def_i', function(e){
//                    var over = $(this).parent().find('.over_i');
//
//                    if(over){
//                        $(this).hide();
//                        $(over).show();
//                    }
//                })
//
//                $('body').on('mouseout', '.banner-img .over_i', function(e){
//                    var def = $(this).parent().find('.def_i');
//
//                    if(def){
//                        $(this).hide();
//                        $(def).show();
//                    }
//                })

		$('body').on('click', '.banner-img .banner-pos ul li', function(e){
			var idx = $(this).index();

			btn.off();
			slide(idx);
			btn.on();
		})
            })

            function animation(arrow){
                var idx = $('.banner-img > ul > li.anishow').index();
                var len = $('.banner-img > ul > li').length;
                var type = $('.banner-img > ul').attr('data-type');

                switch(arrow){
                    case 'next' :
                        idx + 1 == len ? slide(0) : slide(idx + 1);
                    break;
                }
            }

            function slide(idx){
                var len = $('.banner-img > ul > li').length;

                $('.banner-img > ul > li').removeClass('anishow');
                $('.banner-img > ul > li').eq(idx).addClass('anishow');
		$(".banner-pos > ul > li").css({"background-color" : "#000"});
		$(".banner-pos > ul > li").eq(idx).css({"background-color" : "#fff"});

    //            $('.banner-img > ul').stop().animate({"margin-left" : "-"+100 / len * idx+"%" });
                $('.banner-img > ul').stop().animate({"margin-left" : "-"+100 * idx+"%" }, 1000);
            }
        </script>
    </body>

</html>
