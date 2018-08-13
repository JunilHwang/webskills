<?php
    include_once("{$_SERVER['DOCUMENT_ROOT']}/include/lib.php");

    if($_SESSION['userid'] != 'root'){
        msgMove('관리자만 접근가능합니다.', '../login.php');
    }

    if(isset($_POST['second'])){
        foreach($_FILES['m_img']['tmp_name'] as $k=>$v){
            $m_img = '';

            if(is_uploaded_file($_FILES['m_img']['tmp_name'][$k])){
                $type = $_FILES['m_img']['type'][$k];
                
                if($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif'){
                    $m_img = $_FILES['m_img']['name'][$k];

                    move_uploaded_file($_FILES['m_img']['tmp_name'][$k], "../../upload/".$m_img);
                } else {
                    msgMove('이미지만 업로드 가능합니다.', '/admin/page/main-image-design.php');
                }
            }

		$m_img = $m_img == '' ? '' : "m_img='{$m_img}',";
            
            $pdo->query("update main_image set {$m_img} l_order='{$k}', l_back='{$_POST['left-back']}', r_back='{$_POST['right-back']}' where idx='{$_POST['idx'][$k]}'");
            $pdo->query("update image_ani set second='{$_POST['second']}'");
            
            
        }
        msgMove('변경사항이 적용되었습니다.', '/admin/page/main-image-design.php');
    }
?>
<html lang="ko"><head>
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

        <div id="contents" class="main-image">
            <div class="wrap">
               <div class="page-title">
                   <h3>애니메이션 구성</h3>
               </div>
               
               <form class="main-image-frm" method="post" enctype="multipart/form-data" >
                    <table>
                      <colgroup>
                          <col style="width:17%;">    
                          <col style="width:22%;"> 
                          <col style="width:22%;">    
                          <col style="width:22%;"> 
                          <col style="width:17%;"> 
                      </colgroup>
                      
                       <thead>
                           <tr>
                               <th>좌측배경 (옵션)</th>
                               <th>이미지1 (필수)</th>
                               <th>이미지2 (필수)</th>
                               <th>이미지3 (필수)</th>
                               <th>우측배경 (옵션)</th>
                           </tr>
                       </thead>

                       <tbody>
                           <tr >
                               <td>
                                       <span>배경색 : #<input type="text" name="left-back" maxlength="6" value="<?= $pdo->query("select * from main_image")->fetch(2)['l_back'] ?>"><div class="btn" ><button type="button" class="bc-remove c-remove" data-arrow="l">삭제</button></div>
                                   </span>
                               </td>
				<?php
						$list = $pdo->query("select * from main_image");
						while($list_r = $list->fetch(2)){
					?>
                               <td >
					
					<input type="hidden" value="<?= $list_r['idx'] ?>" name="idx[]" >
                                       <span data-idx="<?= $list_r['idx'] ?>" >
<button type="button" class="f_find" style="float:left;">파일 선택</button> <span class="f_name" style="width:auto;"><?= $list_r['m_img'] == '' ? '선택파일없음' : $list_r['m_img'] ?></span><input type="file" class="file" name="m_img[]" style="float:left; width:180px; display:none;" ><div class="btn" ><button type="button" class="bc-remove i-remove" data-idx="<?= $list_r['idx'] ?>" >삭제</button></div>
</span>
                               </td>
					<?php } ?>

                               <td>
                                   <span>
                                       배경색 : #<input type="text" name="right-back" maxlength="6" value="<?= $pdo->query("select * from main_image")->fetch(2)['r_back'] ?>"><div class="btn" ><button type="button" class="bc-remove c-remove" data-arrow="r">삭제</button></div>
                                   </span>
                               </td>
                           </tr>
                       </tbody>
                   </table>
                   
                   <div class="rotaction-sec">
                        <input type="text" name="second" value="<?= $pdo->query("select * from image_ani")->fetch(2)['second']; ?>"><p>초(Sec.) 마다 대표이미지를 변경합니다.</p>
                   </div>
               </form>
               
                
                <div class="save-btn">
                    <button type="button" onclick="$('.main-image-frm').submit();">변경사항 적용하기</button>
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
		$('body').on('click', '.f_find', function(e){
			$(this).parents("span").find('input').click();
		});

		$('body').on('change', '.file', function(e){
			var files = e.target.files[0];
			
			$(this).parents('span').find('.f_name').text(files.name);
		});

		$('body').on('click', '.i-remove', function(e){
			var idx = $(this).parents("span").attr("data-idx");

			$.ajax({
				type : "POST",
				url : "/ajax/i-remove.php",
				data : { idx : idx },
				success : function(data){
					location.reload();
				}
			});
		});

		$('body').on('click', '.c-remove', function(e){
			var arrow = $(this).attr("data-arrow");

			$.ajax({
				type : "POST",
				url : "/ajax/c-remove.php",
				data : { arrow : arrow },
				success : function(data){
					location.reload();
				}
			});
		});
            
            $('body').on('click', '.add-btn-area .add-btn', function(e){
                
                $.ajax({
                    type : "POST",
                    url : "/ajax/main-image-add.php",
                    success : function(data){
                        var html = '<tr>';
                                        html += '<input type="hidden" name="idx[]" value="'+data+'">';
                                        html += '<td style="text-align:center; font-size:14px; "><span style="width:100%;">1</span><button type="button" class="image-remove">삭제</button></td>';
                                       html += '<td>';
                                           html += '<span>';
                                               html += '이미지 : <input type="file" name="l_img[]" >';
                                           html += '</span>';
                                           html += '<span>';
                                               html += '파일 이름 : </span>';
                                           html += '<span>';
                                               html += '배경색 : #<input type="text" name="left-back[]" maxlength="6">';
                                               html += '<button type="button" class="ic-remove" value="" >삭제</button>';
                                           html += '</span>';
                                       html += '</td>';
                                       html += '<td>';
                                            html += '<span>';
                                               html += '파일 : <input type="file" name="m_img[]">';
                                            html += '</span>';
                                               html += '<span>파일 이름 : </span>';
                                           html += '<span>';
                                               html += '링크 : <input type="text" name="link_url[]" value="">';
                                               html += '<select name="move-option[]">';
                                                   html += '<option value="_self">현재창</option>';
                                                   html += '<option value="_blank">새창</option>';
                                               html += '</select>';
                                               html += '<button type="button" class="ic-remove">삭제</button>';
                                           html += '</span>';
                                       html += '</td>';
                                       html += '<td>';
                                           html += '<span>';
                                               html += '이미지 : <input type="file" name="r_img[]">';
                                           html += '</span>';
                                               html += '<span>파일 이름 : </span>';
                                           html += '<span>';
                                               html += '배경색 : #<input type="text" name="right-back[]" maxlength="6" value="">';
                                               html += '<button type="button" class="ic-remove" >삭제</button>';
                                           html += '</span>';
                                       html += '</td>';
                                   html += '</tr>';
                        
                        $('.main-image-frm table tbody').append(html);
                    }
                })
            })
        })
    </script>
</body>
</html>