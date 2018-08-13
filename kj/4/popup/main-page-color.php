<?php
    include_once("../include/lib.php");

    $list = $pdo->query("select * from main_page where idx='{$_GET['idx']}'")->fetch(2);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>메인 페이지 라인 및 배경색 설정</title>
    
    <link rel="stylesheet" href="/css/default.css">
    
    <link rel="stylesheet" href="/css/popup.css">
    
    <link rel="stylesheet" href="/admin/css/admin.css">
    
    <script src='/js/jquery.min.js'></script>
    
    <script src='/js/script.js'></script>
</head>
<body>
    <div class="popup">
        <div class="page-title">
            메인페이지 구성
        </div>

        <form method="post" onsubmit="return frmSubmit(this, '/ajax/main-page-color-save.php', '변경사항이 적용되었습니다.', '');">
            <input type="hidden" name="idx" value="<?= $_GET['idx'] ?>">
            <table class="main-content">
                <colgroup>
                    <col style="width:20%;">
                    <col style="width:80%;">
                </colgroup>

                <tbody>
                    <tr>
                        <td>영역 상단 라인색 (Border Color)</td>
                        <td>
                            <input type="text" name="top_line" value="<?= $list['t_line'] ?>" readonly>
                            <span class="prv-color" style="display:inline-block; vertical-align:middle; width:25px; height:25px; border:1px solid #ccc; <?= $list['t_line'] == '' ? '' : 'background-color:'.$list['t_line'].';' ?>"></span>
                            <img src="/images/color.gif" alt="color">(R, G, B 색상코드 선택)
                            <div class="color-picker"></div>
                        </td>
                    </tr>

                    <tr>
                        <td>영역 하단 라인색 (Border Color)</td>
                        <td>
                            <input type="text" name="bot_line" value="<?= $list['b_line'] ?>" readonly>
                            <span class="prv-color" style="display:inline-block; vertical-align:middle; width:25px; height:25px; border:1px solid #ccc; <?= $list['b_line'] == '' ? '' : 'background-color:'.$list['b_line'].';' ?>"></span>
                            <img src="/images/color.gif" alt="color">(R, G, B 색상코드 선택)
                            <div class="color-picker"></div>
                        </td>
                    </tr>

                    <tr>
                        <td>영역 배경색 (Background Color)</td>
                        <td>
                            <input type="text" name="back-color" value="<?= $list['b_color'] ?>"  readonly>
                            <span class="prv-color" style="display:inline-block; vertical-align:middle;width:25px; height:25px; border:1px solid #ccc; <?= $list['b_color'] == '' ? '' : 'background-color:'.$list['b_color'].';' ?>"></span>
                            <img src="/images/color.gif" alt="color">(R, G, B 색상코드 선택)
                            <div class="color-picker"></div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="save-btn">
                <button type="button">변경사항 적용하기</button>
            </div>
        </form>
    </div>
    
    <script>
        $(function(){
            $('body').on('click', '.save-btn button', function(e){
		$('form').submit();
		
		alert('변경사항이 적용되었습니다.');
                opener.parent.location.reload(); 

		window.close();
            })
            
            $('body').on('click', '.main-content tbody tr td img', function(e){
                var el = $(this);
                
                $.ajax({
                    type : "POST",
                    url : "/ajax/color-picker.php",
                    success : function(data){
                        if($(el).parents("td").find(".color-picker").html() != ''){
                            $(el).parents("td").find(".color-picker").html('');
                            return false;
                        }
                        
                        $(el).parents("td").find('.color-picker').html(data);
                    }
                })
            })
            
            $('body').on('click', '.color-picker span', function(e){
                var cl = $(this).css('background-color');
                
                $(this).parents("td").find("input").val(cl);
            })
        })
    </script>
</body>
</html>