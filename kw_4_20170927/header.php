<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>거래처관리</title>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $base_url?>/css/jquery-ui.css">
<script src="<?php echo $base_url?>/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo $base_url?>/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo $base_url?>/js/common.js" type="text/javascript"></script>
</head>
<body>
<div id="header">
	<div class="wrap">
    	<table id="menu">
        	<tr>
                <?php foreach ($menu as $data): ?>
            	<td><a href="<?php echo $data['link']?>"><?php echo $data['title']?></a></td>
                <?php endforeach ?>
        	<tr>
        </table>
        
		<div class="wrap mat30">
			<div class="w100 ft24">재고현황</div>
            <div id="left_title">
            	<span class="blue">재고 총개수</span> : <span class="red">100</span> 개, &nbsp;
                <span class="blue">재고 총합계</span> : <span class="red">100</span> 원
            </div>
            <table class="list">
                <tr>
                    <th style="width:10%;">제품명</th>
                    <th style="width:20%;">제품개수(총개수)</th>
                    <th style="width:25%;">입고단가</th>
                    <th style="width:35%;">입고날짜</th>
                    <th style="width:10%;">총가격</th>
                </tr>
                

                <tr>
                    <td>테스트</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
             
			</table>
            
		</div> 
        
        <div class="msg">
        	<?php if(isset($msg) && $msg != '') echo nl2br($msg);?>
        </div>
        
		<div class="title"><?php echo $menu[$type]['title']?></div>  
	</div>     
</div>