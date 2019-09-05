<?php
	class OrderModel extends Model{
		/**
		 * get franchisee list
		 * @return object list
		 */
		function getFranList(){
			$list = $this->fetchAll("SELECT * FROM franchisee f JOIN member m ON f.midx = m.idx");
			foreach ($list as $data) {
				$x2 = pow(($this->param->member->x_location - $data->x_location),2);
				$y2 = pow(($this->param->member->y_location - $data->y_location),2);
				$distance = sqrt($x2+$y2);
				$this->query("UPDATE franchisee SET distance = '{$distance}' where idx = '{$data->idx}'");
			}
			$columns = "f.distance, f.idx, f.type, f.logo, f.name, m.x_location, m.y_location, m.tel";
			$join = "JOIN member m ON m.idx = f.midx";
			$cnt = $this->rowCount("SELECT * FROM franchisee f JOIN review r ON r.fidx = f.idx");
			if($cnt){
				$columns .= ", rc.cnt as cnt, avg(r.grade) as avg_grade";
				$join .= " LEFT JOIN reviewCnt rc ON rc.fidx = f.idx LEFT JOIN review r ON r.fidx = f.idx";
			} 
			$condition = "";
			if(isset($_GET['type']) && $_GET['type'] !== "all") $condition .= " where f.type = '{$_GET['type']}'";
			if(isset($_GET['order']) && $cnt){
				switch ($_GET['order']) {
					case 'grade':
						$condition .= " order by avg_grade desc";
						break;
					case 'review':
						$condition .= " order by cnt desc";
						break;
					case 'distance' :
						$condition .= " order by distance desc";
						break;
				}
			}
			$this->sql = "SELECT {$columns} FROM franchisee f {$join} {$condition}";
			$list = $this->fetchAll();
			return $list;
		}

		function getReviewList(){
			$list = $this->fetchAll("SELECT r.*, m.id, m.name FROM review r JOIN member m ON m.idx = r.midx where fidx = '{$_GET['idx']}'");
			return $list;
		}

		function getFran(){
			$list = $this->fetch("SELECT * FROM franchisee f JOIN member m ON f.midx = m.idx where f.idx = '{$_GET['idx']}'");
			return $list;
		}

		function getMenuList(){
			$list = $this->fetchAll("SELECT * FROM menu where fidx = '{$_GET['idx']}'");
			return $list;
		}

		function action(){
			$table = $add_sql = $msg = $url = "";
			extract($_POST);
			switch ($action) {
				case 'addCart':
					$data = $this->fetch("SELECT * FROM menu where idx = '{$_POST['idx']}'");
					$cart = (object) [
						"menu" => "{$data->name}",
						"quantity" => $quantity,
						"price" => "{$data->price}",
						"total_price" => $price
					];
					$_SESSION['cart'][] = $cart;
					exit;
					break;
				case 'write':
					$add_sql = " ,fidx = '{$_GET['idx']}', midx = '{$this->param->member->idx}', date = now()";
					$action = "insert";
					$table = "review";
					$msg = "작성이 완료되었습니다.";
					$url = HOME."/order/details";
					break;
			}
			$cancel = "action/";
			$column = $this->getColumn($_POST,$cancel).$add_sql;
			$this->querySet($action,$table,$column);
			alert($msg);
			move($url);
		}

		function getOrderList(){
			if($this->param->member->level == "N"){
				$list = $this->fetchAll("SELECT d.*, f.logo, f.name FROM deliveryorder d JOIN franchisee f ON f.idx = d.fidx where d.midx = '{$this->param->member->idx}'");
			} else {
				$list = $this->fetchAll("SELECT d.*, f.logo, f.name FROM deliveryorder d JOIN franchisee f ON f.idx = d.fidx");
			}
			return $list;
		}

		function getMemberList(){
			$list = $this->fetchAll("SELECT * FROM member where level == 'N'");
			return $list;
		}
	}