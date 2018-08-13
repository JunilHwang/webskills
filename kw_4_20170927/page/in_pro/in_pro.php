<?php
    $search_product = isset($param[3]) ? $param[3] : NULL;
    $search_start = isset($param[4]) ? $param[4] : date("Y-m-01");
    $search_end = isset($param[5]) ? $param[5] : date("Y-m-t");
    $sql = "SELECT t1.*, (SELECT name from product where idx = t1.product) as name FROM in_pro t1";
    $in_pro = $db->query($sql)->fetchAll();
    $total_in = $total_cnt = $total_price = 0;
    if(isset($_POST['start'])){
        $search_product = $_POST['product'];
        $search_start = $_POST['start'];
        $search_end = $_POST['end'];
    }
    $product_name = '전체';
    if(isset($search_product)){
        $search_part = [];
        if($search_product != ''){
            $search_part[] = " product='{$search_product}'";
            $product_name = $db->query("SELECT name FROM product where idx='{$search_product}'")->fetch()['name'];
        }
        if($search_start || $search_end){
            $search_part[] = " date between '{$search_start}' and '{$search_end}'";
        }
        $sql .= " where ".implode(' and ',$search_part);
    }
    foreach($in_pro as $list){
        $total_in += 1;
        $total_cnt += $list['cnt'];
        $total_price += $list['price']*$list['cnt'];
    }
    $post_date = date("Y-m-d");
    $post_product = $post_price = $post_cnt = "";
    if(isset($_POST['action']) && $msg != '' && $_POST['action'] == 'in_pro_insert'){
        $post_product = $_POST['product'];
        $post_price = $_POST['price'];
        $post_cnt = $_POST['cnt'];
        $post_date = $_POST['date'];
    }
    echo $sql;
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
    $sql .= " order by date desc, name asc limit {$start},$line";
    $in_pro = $db->query($sql)->fetchAll();
?>
<div id="con">
	
	<div class="wrap store">
    	<div>
            <form action="" method="post">
                <input type="hidden" name="action" value="in_pro_insert">
    			<span class="red">*</span> 제품명 : 
                <select name="product">
                	<option value="">제품선택</option>
                    <?php
                        $product = $db->query("SELECT * FROM product order by name asc");
                        foreach($product as $data){
                            $sel = '';
                            if($post_product == $data['idx']) $sel = ' selected';
                            echo "<option value=\"{$data['idx']}\"{$sel}>{$data['name']}</option>";
                        }
                    ?>
                </select>
                
                &nbsp;&nbsp;&nbsp;&nbsp;
                
                <span class="red">*</span> 제품 입고가 : <input type="number" name="price" value="<?php echo $post_price?>" style="width:70px;"> 원
                
                &nbsp;&nbsp;&nbsp;&nbsp;
                
               <span class="red">*</span> 제품개수 : <input type="text" name="cnt" value="<?php echo $post_cnt?>" style="width:70px;" > 
                
                &nbsp;&nbsp;&nbsp;&nbsp;
                
                <span class="red">*</span> 입고날짜 : <input type="text" name="date" value="<?php echo $post_date?>" id="in_date" style="width:150px; text-align:center;">
                &nbsp;&nbsp;&nbsp;&nbsp;
                
                <button type="submit">입고하기</button>
            </form>
        </div>
        
        <div class="in_search">
        	<form action="" method="post">
                
            제품별 : 
            <select name="product">
                <option value="">전 체</option>   
                <?php
                    $product = $db->query("SELECT * FROM product order by name asc");
                    foreach($product as $data){
                        $sel = '';
                        if($search_product == $data['idx']) $sel = ' selected';
                        echo "<option value=\"{$data['idx']}\"{$sel}>{$data['name']}</option>";
                    }
                ?>
            </select>
            
             &nbsp;&nbsp;&nbsp;&nbsp;
             
             시작날짜 : <input type="text" id="s_date" name="start" value="<?php echo $search_start?>" style="width:150px; text-align:center;">
             
             &nbsp;&nbsp;&nbsp;&nbsp;
            
             마지막날짜 : <input type="text" id="e_date" name="end" value="<?php echo $search_end?>" style="width:150px; text-align:center;" >
             
             &nbsp;&nbsp;&nbsp;&nbsp;
             <button type="submit">검색하기</button>            
             
            </form>
        </div>
        
        <div class="s_list">
        
        	<div class="se_re">
            	검색어 : "제품명 : <span class="red"><?php echo $product_name?></span>",
                &nbsp; "시작날짜 : <span class="red"><?php if($search_product) echo $search_start." 이상"; else echo "전체";?> </span>",
                &nbsp;  "마지막날짜 : <span class="red"><?php if($search_product) echo $search_end." 이하"; else echo "전체";?> </span>" 
            </div>
            
            <div class="se_re2"> 
            	총 건수 <span class="red"><?php echo $total_in?></span> 건,
                총 입고개수 <span class="red"><?php echo $total_cnt?></span> 개,
                총 입고금액 <span class="red"><?php echo $total_price?></span> 원
            </div>
        	
        	<table class="list mat40">
            	<tr>
                	<th>제품명</th>
                    <th>입고개수</th>
                    <th>제품입고가</th>
                    <th>총금액</th>
                    <th>입고날짜</th>
                </tr>
                
                <?php foreach ($in_pro as $data): ?>
                <tr>
                    <td><?php echo $data['name']?></td>
                    <td><?php echo $data['cnt']?></td>
                    <td><?php echo $data['price']?></td>
                    <td><?php echo $data['cnt']*$data['price']?></td>
                    <td><?php echo $data['date']?></td>
                </tr>
                <?php endforeach ?>
            
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
</div>