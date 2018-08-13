<?php
    include_once("../include/lib.php");

    $mu = $pdo->query("select * from menu_set where idx='{$_GET['idx']}'")->fetch(2);
?>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>전남관광명소</title>

    <link rel="stylesheet" href="/css/default.css">

    <link rel="stylesheet" href="/css/common.css">

    <script src="/js/jquery.min.js"></script>

    <script src="/js/script.js"></script>
    <link type="text/css" rel="stylesheet" href="chrome-extension://mcahfffbjokgdekljanamhjjbfioffhk/style.css">
    <script type="text/javascript" charset="utf-8" src="chrome-extension://mcahfffbjokgdekljanamhjjbfioffhk/page_context.js"></script>
</head>

<body gtools_scp_screen_capture_injected="true">
    <link rel="stylesheet" href="/css/board.css">
    <div id="wrap">
        <?php
            include_once("../include/header.php");
        ?>

        <div id="contents">
            <div class="wrap">
                <?php
                    if($mu['c_type'] == '2'){
                        echo $mu['c_text'];
                    } else if($mu['c_type'] == '3'){
                        $bds = $pdo->query("select * from board_set where idx='{$mu['c_text']}'")->fetch(2);
                        $bd = $pdo->query("select * from board where bds_idx='{$mu['c_text']}' limit {$bds['page_cnt']}");
                        
                        if($bds['type'] == '1'){
                ?>
                <table class="n_board">
                    <colgroup>
                        <col style="width:50%;">    
                    </colgroup>

                    <thead>
                        <tr>
                            <th>전체 : <?= $bd->rowCount(); ?><b></b></th>
                            <th>글번호</th>
                            <th>작성자</th>
                            <th>작성일시</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            while($list_r = $bd->fetch(2)){
                                $mb_r = $pdo->query("select * from member where idx='{$list_r['memberidx']}'")->fetch(2);
                        ?>
                        <tr onclick="link('/page/bd-view.php?idx=<?= $list_r['idx'] ?>');">
                            <td></td>
                            <td><?= $list_r['idx'] ?></td>
                            <td><?= $mb_r['username'] ?></td>
                            <td><?= $list_r['datetime'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } else if($bds['type'] == '2'){ ?>
                <div class="b_board">
                    <ul>
                        <?php
                            while($list_r = $bd->fetch(2)){
                                $mb_r = $pdo->query("select * from member where idx='{$list_r['memberidx']}'")->fetch(2);
                        ?>
                        <li onclick="link('/page/bd-view.php?idx=<?= $list_r['idx'] ?>');">
                            <h4 style="margin-right:10px;"><?= $list_r['idx'] ?></h4>
                            
                            <span class="img-area">
                                <img src="/upload/" alt="img">
                            </span>
                            
<!--
                            <span class="no-img">
                                No Image
                            </span>
-->
                            
                            <div class="l-info">
                                <h3><?= $list_r['title'] ?></h3>
                                <h5><?= $list_r['datetime'] ?></h5>
                                <p><?= $list_r['text'] ?></p>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } else if($bds['type'] == '3'){ ?>
                <div class="c_board">
                    <ul>
                        <?php
                            while($list_r = $bd->fetch(2)){
                                $mb_r = $pdo->query("select * from member where idx='{$list_r['memberidx']}'")->fetch(2);
                        ?>
                        <li onclick="link('');" >
                            <div class="box">
                                <div class="img" style="background-image:url('/upload/');">
                                    <img src="" alt="">
                                </div>
                                
<!--
                                <div class="no-image img" >
                                    <p>No Image</p>
                                </div>
-->
                                
                                <span class="b-no"><?= $list_r['idx'] ?></span>

                                <h3><?= $list_r['title'] ?></h3>

                                <p class="bd-from"><?= $mb_r['username'] ?></p>

                                <ul>
                                    <li>일시 <span><?= $list_r['datetime'] ?></span></li>
                                    <li>조회 <span><?= $list_r['hit'] ?></span></li>
                                </ul>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
                
                <?php } else if($mu['c_type'] == '0'){ ?>
                <div class="no-page">
                    <div class="no-page-area">
                        <div class="warning">
                            <img src="/images/warning.png" alt="warning">
                        </div>

                        <h2>현재 페이지는 연동이 되어있지 않습니다.</h2>
                        <p>관리자에게 문의 바랍니다.</p>

                        <button type="button">홈으로</button>
                    </div>
                </div>
                <?php } ?>
<!--
               <table class="n_board">
                    <colgroup>
                        <col style="width:50%;">    
                    </colgroup>

                    <thead>
                        <tr>
                            <th>전체 : <b></b></th>
                            <th>글번호</th>
                            <th>작성자</th>
                            <th>작성일시</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr onclick="link('');">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
-->
<!--
                <div class="b_board">
                    <ul>
                        <li onclick="link('/page/bd-view.php?idx=');">
                            <h4 style="margin-right:10px;"></h4>
                            
                            <span class="img-area">
                                <img src="/upload/" alt="">
                            </span>
                            <span class="no-img">
                                No Image
                            </span>
                            
                            <div class="l-info">
                            
                                <h3>제목</h3>
                                <h5>날짜</h5>
                                <p>텍스트</p>
                            </div>
                        </li>
                    </ul>
                </div>
-->
               
<!--
                <div class="c_board">
                    <ul>
                        <li onclick="link('');" >
                            <div class="box">
                                <div class="img" style="background-image:url('/upload/');">
                                    <img src="" alt="">
                                </div>
                                <div class="no-image img" >
                                    <p>No Image</p>
                                </div>
                                
                                <span class="b-no"></span>

                                <h3>제목</h3>

                                <p class="bd-from">작성자</p>

                                <ul>
                                    <li>일시 <span></span></li>
                                    <li>조회 <span></span></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
-->
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

</body>

</html>
