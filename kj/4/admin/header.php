<div id="header">
    <div class="wrap">
        <div class="hd-top">
            <div id="logo">
                <h1><a href="/admin/index.php">ADMIN</a></h1>
            </div>

            <a href="/" class="home-move">홈페이지로 이동</a>
            <p><a href="#">LOG OUT</a></p>
        </div>

        <div class="hd-bot">
            <ul>
                <li>
                    <a href="#">관리 메뉴</a>
                </li>
            </ul>

            <div class="submenu" style="display:none;">
                <ul>
                    <li><a href="#">홈페이지 관리</a></li>
                    <li><a href="/admin/page/menu_set.php">메뉴관리</a></li>
                    <li><a href="/admin/page/main-page.php">메인페이지 구성</a></li>
                    <li><a href="/admin/page/menu-contents.php">메뉴별컨텐츠</a></li>
                    <li><a href="/admin/page/main-image-design.php">애니메이션 구성</a></li>
                </ul>

                <ul>
                    <li><a href="/admin/page/board-set.php">게시판</a></li>
                    <li><a href="/admin/page/board-set.php">설정</a></li>
                </ul>

<span class="menu-pos1">메뉴 열어두기</span>
            <span class="menu-pos2" style="display:none;" >메뉴 접기</span>
            </div>
        </div>
    </div>        
</div>

<script>
    $(function(){
        $('body').on('click', '.submenu .menu-pos1', function(e){
            sessionStorage.setItem('menu', '1');
            
            $('.submenu .menu-pos1').hide();
            $('.submenu .menu-pos2').show();
        })
        
        $('body').on('click', '.submenu .menu-pos2', function(e){
            sessionStorage.setItem('menu', '');
            
            $("#contents").css({"margin-top" : "0"});
            $('.submenu').slideUp(500);
            $('.submenu .menu-pos1').show();
            $('.submenu .menu-pos2').hide();
        })
        
        if(sessionStorage.getItem('menu') == '1'){
            $('.submenu').show();
            $("#contents").css({"margin-top" : "160px"});
            
            $('.submenu .menu-pos1').hide();
            $('.submenu .menu-pos2').show();
        }
        
        // 시간
//        setInterval(function(){
//            var date = new Date();
//            var week = new Array('일', '월', '화', '수', '목', '금', '토');
//            
//            var d_html = "Server : "+(date.getFullYear())+"/"+(date.getMonth()+1 < 10 ? "0"+(date.getMonth()+1) : (date.getMonth()+1))+"/"+(date.getDate())+" ("+week[date.getDay()]+") "+(date.getHours())+":"+(date.getMinutes());
//            
//            $('.time p').html(d_html);
//        }, 1000);
    })
</script>