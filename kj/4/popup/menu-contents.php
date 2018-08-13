<?php
    include_once("../include/lib.php");

    $list = $pdo->query("select * from menu_set where idx='{$_GET['idx']}'")->fetch(2);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>메인 페이지 컨텐츠 설정</title>
    
    <link rel="stylesheet" href="/css/default.css">
    
    <link rel="stylesheet" href="/css/popup.css">
    
    <link rel="stylesheet" href="/admin/css/admin.css">
    
    <script src='/js/jquery.min.js'></script>
    
    <script src='/js/script.js'></script>
    <style>
        #menu-contents {
            float: left;
            width: 100%;
            padding: 0 10px;
        }

        .page-title {
            float: left;
            width: 100%;
            border-bottom: 1px solid #dfdfdf;
            padding: 8px 3px;
            margin-bottom: 10px;
        }

        .menu-type {
            float: left;
            width: 100%;
            background-color: #333;
            padding: 8px 5px;
        }

        .menu-type button {
            padding: 10px 5px;
            background-color: #1f1f1f;
            color: #fff;
        }

        .menu-type button.active {
            color: #dedede;
        }

        .board-connect>form>table {
            float: left;
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .board-connect>form>table>thead>tr>th {
            background-color: #eee;
            border: 1px solid #ccc;
            padding: 5px 0;
            font-size: 14px;
        }

        .board-connect>form>table>tbody>tr>td {
            border: 1px solid #ccc;
            padding: 5px 0;
            text-align: center;
        }

        .table1 tbody tr td select {
            width: 200px;
            height: 28px;
            background-color: #eee;
        }

        .table2>tbody>tr>td {
            padding: 10px !important;
        }

        .table2>tbody>tr>td table {
            float: left;
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        .table2>tbody>tr>td table tbody tr td:nth-child(1) {
            background-color: #efefef;
            font-weight: bold;
        }

        .table2>tbody>tr>td table tbody tr td {
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .table2>tbody>tr>td table tbody tr td:nth-child(2) {
            padding: 8px 0;
            text-align: left;
            padding-left: 8px;
        }

        .table2>tbody>tr>td table tbody tr td:nth-child(2) input[type='text'] {
            border: 1px solid #ccc;
            float: left;
            width: 250px;
            height: 25px;
            margin-right: 5px;
        }

        .table2>tbody>tr>td table tbody tr td:nth-child(2) select {
            height: 25px;
        }

        .table2>tbody>tr>td ul {}

        .table2>tbody>tr>td ul li {
            float: left;
            width: 100%;
            line-height: 30px;
        }
        
        textarea {
            float:left;
            width:100%; 
            height:250px;
        }
    </style>
</head>
<body>
    <div id="menu-contents">        
        <div class="page-title">
            메뉴별 컨텐츠
        </div>
        
        <div class="menu-type">
            <button type="button" data-idx="<?= $_GET['idx'] ?>" data-type="1">초기화</button>
            <button type="button" data-type="2">HTML 입력</button>
            <button type="button" data-type="3">게시판 연동</button>
        </div>
        
        <div class="board-connect">
            <form method="post" class="table3-frm" onsubmit="return frmSubmit(this, '/ajax/menu-contents-save.php', '변경사항이 적용되었습니다.', '/popup/menu-contents.php?idx=<?= $_GET['idx'] ?>');">
                <input type="hidden" name="type" value="3">
                <input type="hidden" name="idx" value="<?= $_GET['idx'] ?>">
                <table class="table2">
                    <thead>
                        <tr>
                            <th>현재설정 : 게시판을 연동합니다.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <select name="board" id="board">
                                    <option value="">선택하세요.</option>
                                    <?php
                                        $bds = $pdo->query("select * from board_set");
                                        while($list_r = $bds->fetch(2)){
                                    ?>
                                    <option value="<?= $list_r['idx'] ?>"><?= $list_r['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            
           <form method="post" class="table2-frm" style="display:none;" enctype="multipart/form-data" onsubmit="return frmSubmit(this, '/ajax/menu-contents-save.php', '변경사항이 적용되었습니다.', '/popup/menu-contents.php?idx=<?= $_GET['idx'] ?>');">
                <input type="hidden" name="idx" value="<?= $_GET['idx'] ?>">
                <input type="hidden" name="type" value="2">
                <table class="table1">
                    <thead>
                        <tr>
                            <th>현재설정 : 내용을 작성합니다.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <textarea name="text"><?= $list['c_text'] ?></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <div class="save-btn" data-type="3" >
                <button type="button">변경사항 적용하기</button>
            </div>
        </div>
    </div>
    
    <script>
        $(function(){
            $('body').on('click', '.menu-type button', function(e){
                var type = $(this).attr('data-type');
                
                if(type == '1'){
                    if(confirm('초기화 하시겠습니까?')){
                        var idx = $(this).attr('data-idx');
                        
                        $.ajax({
                            type : "POST",
                            url : "/ajax/main-page-cont-reset.php",
                            data : { idx : idx },
                            success : function(data){
                                alert('초기화가 완료되었습니다.');
                                opener.parent.location.reload();
                                location.reload();
                            }
                        })  
                    }
                } else {
                    $('.save-btn').attr('data-type', type);
                    $('.board-connect > form').hide();
                    $('.table'+type+'-frm').show();
                }
            })
            
            $('body').on('click', '.save-btn button', function(e){
                var type = $(this).parent().attr('data-type');
                
                $('.table'+type+'-frm').submit();
		alert('변경사항이 적용되었습니다.');
		window.close();
                opener.parent.location.reload();
            })
            
            
        })
    </script>
</body>
</html>