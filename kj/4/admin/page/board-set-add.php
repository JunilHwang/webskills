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
        <div id="wrap" class="admin">
            <?php
            include_once("../header.php");
        ?>

                <div id="contents" class="board-set">
                    <div class="wrap">
                        <div class="page-title">
                            <h3>게시판 생성</h3>
                        </div>

                        <form method="post" class="board-add-frm" onsubmit="return frmSubmit(this, '/ajax/board-set-add.php', '게시판이 생성되었습니다.', './board-set.php');">
                            <div class="board-table">
                                <table>
                                    <colgroup>
                                        <col style="width:15%;">
                                        <col style="width:85%;">
                                    </colgroup>

                                    <tbody>
                                        <tr>
                                            <td>이름</td>
                                            <td><input type="text" name="board-name"></td>
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
                                                            <input type="radio" name="board_type" value="1" checked="" data-type="a">
                                                            타입A <button type="button" class="detail_set" data-type="a">세부설정</button>
                                                        </span>
                                                            </td>

                                                            <td>
                                                                <span>
                                                            <img src="/images/board_type_2.gif" alt="type2">
                                                            뉴스형 : 사진+제목+내용
                                                        </span>

                                                                <span>
                                                            <input type="radio" name="board_type" value="2" data-type="b">
                                                            타입B <button type="button" class="detail_set" data-type="b" >세부설정</button>
                                                        </span>
                                                            </td>

                                                            <td>
                                                                <span>
                                                            <img src="/images/board_type_3.gif" alt="type3">
                                                            앨범형 : 사진 위주
                                                        </span>

                                                                <span>
                                                            <input type="radio" name="board_type" value="3" data-type="c">
                                                            타입C <button type="button" class="detail_set" data-type="c" >세부설정</button>
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
                                                            <td>라인(행) 사진 개수</td>
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
                                                            <input type="radio" name="line_cnt" value="4" checked="">
                                                            4개
                                                        </span>

                                                                <span>
                                                            <input type="radio" name="line_cnt" value="5">
                                                            5개
                                                        </span>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>한 페이지 라인(행)의 개수</td>
                                                            <td>
                                                                <select name="page_cnt3" id="">
                                                            <option value="1">1</option>
                                                            <option value="2">3</option>
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
                                            <p>글 작성시 첨부할 수 있는 파일의 용량과 개수를 설정합니다. (기본설정 : 첨부 파일 최대 5개)</p>

                                            <button type="button" class="file-set">설정변경</button>
                                        </span>

                                                <span class="file-set-area" style="display:none;">
                                           첨부파일 허용 개수 : <select name="file_cnt" id="file_cnt">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3" selected="">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>,</span>

                                                <span class="file-set-area" style="display:none;">
                                                첨부파일 하나당 제한 용량 : <select name="f_size" id="f_size">
                                                <option value="1">1 M</option>
                                                <option value="2" selected="">2 M</option>
                                                <option value="3">3 M</option>
                                                <option value="4">4 M</option>
                                                <option value="5">5 M</option>
                                                
                                            </select>
                                        </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <div class="save-btn">
                            <button type="button" onclick="$('form').submit();">게시판 생성</button>
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
            $(function() {
                $('body').on('click', '.f_upload .file-set', function(e) {
                    $('.f_upload .file-set-area').toggle();
                })

		$('body').on('click', '.detail_set', function(e){
			var type = $(this).attr('data-type');
			var chk = $('input[name="board_type"]:checked').attr('data-type');
			
			$('.set_table').hide();
			$('.'+chk+'_table').show();
		})

		$('body').on('change', 'input[name="board_type"]', function(e){
			$('.set_table').hide();

			$(this).parents("span").find('.detail_set').show();
			
		});
            })

        </script>

    </body>

    </html>
