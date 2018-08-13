<?php
    $sql = "SELECT * FROM product";
    $post_name = '';
    $post_price = '';
    $post_description = '';
    if(isset($msg) && $msg != '' && $_POST['action'] == 'product_insert'){
        $post_name = $_POST['name'];
        $post_price = $_POST['price'];
        $post_description = $_POST['description'];
    }
?>
<div id="con">
	<div class="wrap store">	
		<table>
            <form action="" method="post">
                <input type="hidden" name="action" value="product_insert">
                <tr>
                    <td class="al">
                        <span class="red">*</span> 제품명 : <input type="text" name="name" style="width:130px;" value="<?php echo $post_name ?>"> &nbsp;&nbsp;
                        <span class="red">*</span> 제품 출고가 : <input type="text" name="price" style="width:130px;" value="<?php echo $post_price ?>"> &nbsp;&nbsp;
                        <span class="blue">*</span> 비 고 : <input type="text" name="description" style="width:500px;" value="<?php echo $post_description ?>"> &nbsp;&nbsp;
                        <button class="submit">제품 등록</button>
                    </td>
                </tr>
            </form>
            <form action="" method="post" id="productUpdate">
                <input type="hidden" name="action" value="product_update">
                <input type="hidden" name="price" value="">
                <input type="hidden" name="description" value="">
                <input type="hidden" name="idx" value="">
            </form>
        </table>
        
        <table class="list mat10">
        	<tr>
            	<th style="width:5%;">번 호</th>
                <th style="width:15%;">제품명</th>
                <th style="width:20%;">출고가</th>
                <th>비 고</th>
                <th style="width:8%;">수 정</th>
            </tr>
        
        
            
            <?php
                $data = $db->query($sql);
                foreach($data as $list){
            ?>
            <tr>
                <td><?php echo $list['idx']?></td>
                <td><?php echo $list['name']?></td>
                <td><input type="text" name="price" class="price" value="<?php echo $list['price']?>" width="100%"></td>
                <td><input type="text" name="description" class="description" value="<?php echo $list['description']?>" width="100%"></td>
                <td><a href="#" class="update" data-idx="<?php echo $list['idx']?>">수정</a></td>
            </tr>
            <?php
                }
            ?>
            

	
        </table>
        
        
	</div>
</div>
<script>
    $(document).on('click','.update',function(){
        var price = $(this).parent().parent().find('.price').val();
        var description = $(this).parent().parent().find('.description').val();
        productUpdate.price.value = price;
        productUpdate.description.value = description;
        productUpdate.idx.value = $(this).data('idx');
        productUpdate.submit();
        return false;
    })
</script>