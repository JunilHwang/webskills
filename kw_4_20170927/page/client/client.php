<?php
    $sql = "SELECT * FROM client";
    $total = $db->query($sql)->rowCount();
    $line = 5;
    $start = ($page_num - 1) * $line;
    $prev_num = $page_num - 1;
    $next_num = $page_num + 1;
    $last = ceil($total/$line);
    if(!$last) $last = 1;
    $base_link = "{$menu[$type]['link']}/{$type}/";
    $prev_link = $base_link.$prev_num;
    $next_link = $base_link.$next_num;
    $sql .= " order by binary(name) asc limit {$start},{$line}";
?>
<div id="con">
	<div class="wrap store">
        <form action="" method="post">
            <input type="hidden" name="action" value="client_insert">
    		<table>
            	<tr>  
                	<td><span class="red">*</span> 거래처 이름 : <input type="text" name="name" <?php if(isset($msg) && $msg != '') echo " value=\"{$_POST['name']}\""?> style="width:150px;"></td>
                    <td><span class="red">*</span> 거래처 전화번호 : <input type="text" name="tel" <?php if(isset($msg) && $msg != '') echo " value=\"{$_POST['tel']}\""?> style="width:150px;"></td>
                    <td><span class="red">*</span> 거래처 주소 : <input type="text" name="address" <?php if(isset($msg) && $msg != '') echo " value=\"{$_POST['address']}\""?> style="width:300px"></td>
                    <td><button type="submit">거래처 등록</button></td>
                </tr>
            </table>
        </form>
        <form action="" method="post" id="clientDelete">
            <input type="hidden" name="action" value="client_delete">
            <input type="hidden" name="idx" value="">
        </form>
        
        <table class="list mat10">
        	<tr>
            	<th style="width:5%;">번 호</th>
                <th style="width:15%;">이 름</th>
                <th style="width:15%;">전화번호</th>
                <th>주 소</th>
                <th style="width:12%;">등록일</th>
            	<th style="width:8%;">삭 제</th>
            </tr>
            <?php
                $data = $db->query($sql);
                foreach($data as $list){
            ?>
            <tr>
                <td><?php echo $list['idx']?></td>
                <td><?php echo $list['name']?></td>
                <td><?php echo $list['tel']?></td>
                <td><?php echo $list['address']?></td>
                <td><?php echo $list['date']?></td>
                <td><a href="#" onclick="clientDelete.idx.value = '<?php echo $list['idx']?>'; clientDelete.submit(); return false;">삭제</a></td>
            </tr>
            <?php
                }
            ?>
        </table>
        
        <div class="w100 ac mat20">
    	
            <?php  
                if($page_num == 1){
            ?>
            <button type="button">이전</button>
            <?php
                } else {
            ?>
            <button type="button" onclick="location.href = '<?php echo $prev_link;?>'">이전</button>
            <?php
                }
            ?>                
            <?php
                for($i=1;$i<=$last;$i++){
            ?>
            <button type="button" onclick="location.href = '<?php echo $base_link.$i;?>'"><?php echo $i?></button>
            <?php
                }
            ?>

            <?php if ($page_num < $last){ ?>
            <button type="button" onclick="location.href = '<?php echo $next_link;?>'">다음</button>
            <?php } else { ?>
            <button type="button">다음</button>
            <?php } ?>

        </div>
        
	</div>
</div>