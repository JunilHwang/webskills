<?php
    include_once("{$_SERVER['DOCUMENT_ROOT']}/include/lib.php");

    if($_SESSION['userid'] != 'root'){
        msgMove('관리자만 접근가능합니다.', '../login.php');
    }

    $bds = $pdo->query("select * from board_set where idx='{$_GET['idx']}'")->fetch(2);
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
    <div id="wrap" class="admin">
        <?php
            include_once("../header.php");
        ?>

        <div id="contents" class="board-set">
            <div class="wrap">
                <div class="page-title">
                    <h3>게시판 수정</h3>
                </div>
                
                <form method="post" class="board-add-frm" onsubmit="return frmSubmit(this, '/ajax/board-set-modify.php', '게시판이 수정되었습니다.', './board-set.php');">
                    <input type="hidden" name="idx" value="<?= $_GET['idx'] ?>">
                    <div class="board-table">
                        <table>
                            <colgroup>
                                <col style="width:15%;">
                                <col style="width:85%;">
                            </colgroup>

                            <tbody>
                                <tr>
                                    <td>이름</td>
                                    <td><input type="text" name="board-name" value="<?= $bds['name'] ?>"></td>
                                </tr>

                                <tr>
                                    <td>타입</td>
                                    <td>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th colspan="3">리스트(글목록)타입</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr class="b_type">
                                                    <td>
                                                        <span>
                                                            <img src="/images/board_type_1.gif" alt="type1">
                                                            일반형 : 텍스트 위주
                                                        </span>

                                                        <span>
                                                            <input type="radio" name="board_type" value="1" <?= $bds['type'] == '1' ? 'checked' : '' ?> data-type="a" >
                                                            타입A <button type="button" class="detail_set" data-type="a">세부설정</button>
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <span>
                                                            <img src="/images/board_type_2.gif" alt="type2">
                                                            뉴스형 : 사진+제목+내용
                                                        </span>

                                                        <span>
                                                            <input type="radio" name="board_type" value="2" <?= $bds['type'] == '2' ? 'checked' : '' ?> data-type="b" >
                                                            타입B <button type="button" class="detail_set" data-type="b">세부설정</button>
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <span>
                                                            <img src="/images/board_type_3.gif" alt="type3">
                                                            앨범형 : 사진 위주
                                                        </span>

                                                        <span>
                                                            <input type="radio" name="board_type" value="3" <?= $bds['type'] == '3' ? 'checked' : '' ?> data-type="c" >
                                                            타입C <button type="button" class="detail_set" data-type="c">세부설정</button>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                        <table class="a_table set_table" style="display:none;">
                                            <colgroup>
                                                <col style="width:25%;">
                                                <col style="width:75%;">
                                            </colgroup>
                                            
                                            <tbody>
                                                <tr>
                                                    <td>한 페이지 게시물 개수</td>
                                                    <td>
                                                        <select name="page_cnt1" id="">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                        <table class="b_table set_table" style="display:none;">
                                            <colgroup>
                                                <col style="width:25%;">
                                                <col style="width:75%;">
                                            </colgroup>
                                            
                                            <tbody>
                                                <tr>
                                                    <td>한 페이지 게시물 개수</td>
                                                    <td>
                                                        <select name="page_cnt2" id="">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                        <table class="c_table set_table" style="display:none;">
                                            <colgroup>
                                                <col style="width:25%;">
                                                <col style="width:75%;">
                                            </colgroup>
                                            
                                            <tbody>
                                               <tr>
                                                    <td>라인(행) 게시물 개수</td>
                                                    <td>
                                                        <span>
                                                            <input type="radio" name="line_cnt" value="1" checked="">
                                                            1개
                                                        </span>
                                                        
                                                        <span>
                                                            <input type="radio" name="line_cnt" value="2">
                                                            2개
                                                        </span>
                                                        
                                                        <span>
                                                            <input type="radio" name="line_cnt" value="3">
                                                            3개
                                                        </span>
                                                        
                                                        <span>
                                                            <input type="radio" name="line_cnt" value="4">
                                                            4개
                                                        </span>
                                                        
                                                        <span>
                                                            <input type="radio" name="line_cnt" value="5">
                                                            5개
                                                        </span>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>한 페이지 게시물 개수</td>
                                                    <td>
                                                        <select name="page_cnt3" id="">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                
                                                
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr class="f_upload">
                                    <td>첨부파일 업로드</td>
                                    <td>
                                        <span>
                                            <p>글 작성시 첨부할 수 있는 파일의 용량과 개수를 설정합니다. (기본설정 : 첨부 파일 최대 3개)</p>

                                            <button type="button" class="file-set">설정변경</button>
                                        </span>

                                        <span class="file-set-area" style="display:none;">
                                           첨부파일 허용 개수 : <select name="file_cnt" id="file_cnt">
                                            <?php
                                                for($i = 0; $i <= 5; $i++){
                                            ?>
                                            <option value="<?= $i ?>" <?= $bds['upload_cnt'] == $i ? 'selected' : '' ?> ><?= $i ?></option>
                                            <?php } ?>
                                        </select>,</span>

                                        <span class="file-set-area" style="display:none;">
                                            첨부파일 하나당 제한 용량 : <select name="f_size" id="f_size">
                                            <?php
                                                for($i = 0; $i <= 5; $i++){
                                            ?>
                                            <option value="<?= $i ?>" <?= $bds['upload_size'] == $i ? 'selected' : '' ?> ><?= $i ?> M</option>
                                            <?php } ?>

                                            </select>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
                
                <div class="save-btn">
                    <button type="button" onclick="$('form').submit();">게시판 수정</button>
                    <button type="button" class="bd-remove" data-idx="<?= $_GET['idx'] ?>">게시판 삭제</button>
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
            $('body').on('click', '.f_upload .file-set', function(e){
                 $('.f_upload .file-set-area').toggle();
            })
            
            $('body').on('click', '.bd-remove', function(e){
                var idx = $(this).attr('data-idx');
                
                $.ajax({
                    type : "POST",
                    url : "/ajax/board-set-remove.php",
                    data : { idx : idx },
                    success : function(data){
                        alert('게시판이 삭제되었습니다.');
			link('./board-set.php');
                    }
                })
            })

$('body').on('click', '.detail_set', function(e){
			var type = $(this).attr('data-type');
			var chk = $('input[name="board_type"]:checked').attr('data-type');
			
			$('.set_table').hide();
			$('.'+chk+'_table').show();
		})
        })
    </script>

</body>
</html>