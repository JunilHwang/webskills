<?php
	if(isset($_POST['action'])){
		$sql = $msg = "";
		switch($_POST['action']){
			case 'client_insert' :
				$sql  = "INSERT INTO client set ";
				$sql .= " name='{$_POST['name']}'";
				$sql .= ",tel='{$_POST['tel']}'";
				$sql .= ",address='{$_POST['address']}'";
				$sql .= ",date=now()";
				if($_POST['name'] == '') $msg .= "거래처 이름을 입력해주세요.\n";
				if($_POST['tel'] == '') $msg .= "거래처 전화번호 입력해주세요.\n";
				if($_POST['address'] == '') $msg .= "거래처 주소를 입력해주세요.";
				if($db->query("SELECT * FROM client where name='{$_POST['name']}'")->rowCount()){
					$msg = "이미 등록된 거래처가 있습니다.";
				}
			break;
			case 'client_delete' :
				$sql = "DELETE FROM client where idx='{$_POST['idx']}'";
			break;
			case 'product_insert' :
				$sql  = "INSERT INTO product set ";
				$sql .= " name='{$_POST['name']}'";
				$sql .= ",price='{$_POST['price']}'";
				$sql .= ",description='{$_POST['description']}';";
				if($_POST['name'] == '') $msg .= "제품 이름을 입력해주세요.\n";
				if($_POST['price'] == '') $msg .= "제품 출고가를 입력해주세요.\n";
				if($db->query("SELECT * FROM product where name='{$_POST['name']}'")->rowCount()){
					$msg = "이미 등록된 제품이 있습니다.";
				}
			break;
			case 'product_update' :
				$sql  = "UPDATE product set ";
				$sql .= " price='{$_POST['price']}'";
				$sql .= ",description='{$_POST['description']}'";
				$sql .= "where idx='{$_POST['idx']}'";
				if($_POST['price'] == '') $msg .= "제품 출고가를 입력해주세요.\n";
			break;
			case 'in_pro_insert' :
				$sql  = "INSERT INTO in_pro set ";
				$sql .= " product='{$_POST['product']}'";
				$sql .= ",price='{$_POST['price']}'";
				$sql .= ",cnt='{$_POST['cnt']}'";
				$sql .= ",date='{$_POST['date']}';";
				if($_POST['product'] == '') $msg .= "제품을 선택해주세요.\n";
				if($_POST['price'] == '') $msg .= "제품 입고가를 입력해주세요.\n";
				if($_POST['cnt'] == '') $msg .= "제품 개수를 입력해주세요.\n";
				if($_POST['date'] == '') $msg .= "제품 입고날짜를 입력해주세요.\n";
				if($_POST['product'] != '' && $db->query("SELECT * FROM product where price<='{$_POST['price']}'")->rowCount())
					$msg  .= "제품 입고가가 잘못입력되었습니다.";
			break;
		}
		if($msg == "") $db->query($sql);
		echo $sql;
	}
?>