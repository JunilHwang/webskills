<?php
    include_once("../include/lib.php");

    $list = $pdo->query("select * from main_page where idx='{$_GET['idx']}'")->fetch(2);

    if(isset($_POST['type'])){
        if($_POST['type'] == '1'){
            if($_POST['board'] == ''){
                msgMove('게시판을 선택해주세요.', '/popup/main-page-cont-set.php?idx='.$_GET['idx']);
            }
            
            $pdo->query("update main_page set c_type='{$_POST['type']}', b_idx='{$_POST['board']}' where idx='{$_POST['idx']}'");
            alert('변경사항이 적용되었습니다.');
            echo "<script>opener.parent.location.reload(); window.close();</script>";

        } else if($_POST['type'] == '2'){
            $d_img = '';
            if(is_uploaded_file($_FILES['def_img']['tmp_name'])){
                $type = $_FILES['def_img']['type'];
                
                if($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif'){
                    $d_img = $_FILES['def_img']['name'];
                    
                    move_uploaded_file($_FILES['def_img']['tmp_name'], "../upload/".$d_img);
                } else {
                    msgMove('이미지만 업로드 가능합니다.', '/popup/main-page-cont-set.php?idx='.$_GET['idx']);
                }
            } else {
                msgMove('기본 이미지는 필수 사항입니다.', '/popup/main-page-cont-set.php?idx='.$_GET['idx']);
            }
            
            $o_img = '';
            if(is_uploaded_file($_FILES['over_img']['tmp_name'])){
                $type = $_FILES['over_img']['type'];
                
                if($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif'){
                    $o_img = $_FILES['over_img']['name'];
                    
                    move_uploaded_file($_FILES['over_img']['tmp_name'], "../upload/".$o_img);
                } else {
                    msgMove('이미지만 업로드 가능합니다.', '/popup/main-page-cont-set.php?idx='.$_GET['idx']);
                }
            }
            
            $m_type = $_POST['link_type'] == '1' ? '_SELF' : '_blank';
            
            $pdo->query("update main_page set c_type='{$_POST['type']}', def_img='{$d_img}', over_img='{$o_img}', l_url='{$_POST['link_url']}', m_type='{$m_type}' where idx='{$_POST['idx']}'");
            
            alert('변경사항이 적용되었습니다.');
            echo "<script>opener.parent.location.reload(); window.close();</script>";
        }
    }
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
    </style>
</head>
<body>
    <div id="menu-contents">        
        <div class="page-title">
            메인페이지 컨텐츠
        </div>
        
        <div class="menu-type">
            <button type="button" data-idx="<?= $_GET['idx'] ?>" data-type="3">초기화</button>
            <button type="button" data-type="2">배너 연동</button>
            <button type="button" data-type="1">게시판 연동</button>
        </div>
        
        <div class="board-connect">
            <form method="post" class="table1-frm">
                <input type="hidden" name="idx" value="<?= $_GET['idx'] ?>">
                <table class="table1">
                    <thead>
                        <tr>
                            <th>현재설정 : 게시판을 연동합니다.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <input type="hidden" name="type" value="1">
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
            
           <form method="post" class="table2-frm" style="display:none;" enctype="multipart/form-data">
                <input type="hidden" name="idx" value="<?= $_GET['idx'] ?>">
                <table class="table2">
                    <thead>
                        <tr>
                            <th>현재설정 : 배너를 연동합니다.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>기본 이미지 (필수사항)</td>
                                            <td>
                                                <input type="hidden" name="type" value="2">
                                                <ul>
                                                    <li>
                                                        <?php
                                                            if($list['def_img'] == ''){
                                                        ?>   
                                                        설정된 이미지가 없습니다.(GIF, JPG, PNG 파일만 업로드 가능합니다)
                                                        <?php } else { ?>
                                                        이미지 : <?= $list['def_img'] ?>
                                                        <?php } ?>
                                                    </li>
                                                    <li><input type="file" name="def_img"></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>오버 이미지 (선택사항)</td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <?php
                                                            if($list['over_img'] == ''){
                                                        ?>   
                                                        설정된 이미지가 없습니다.(GIF, JPG, PNG 파일만 업로드 가능합니다)
                                                        <?php } else { ?>
                                                        이미지 : <?= $list['over_img'] ?>
                                                        <?php } ?>
                                                    </li>
                                                    <li><input type="file" name="over_img"></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>링크 URL</td>
                                            <td>
                                                <input type="text" name="link_url" value="">
                                                <select name="link_type" id="">
                                                    <option value="1">현재창(_SELF)</option>
                                                    <option value="2">새창(_blank)</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <div class="save-btn" data-type="1" >
                <button type="button">변경사항 적용하기</button>
            </div>
        </div>
    </div>
    
    <script>
        $(function(){
            $('body').on('click', '.menu-type button', function(e){
                var type = $(this).attr('data-type');
                
                if(type == '3'){
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
            })
        })
    </script>
</body>
</html>