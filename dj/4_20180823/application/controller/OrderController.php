<?php
	class OrderController extends Controller{
		/**
		 * Order Page
		 */
		function order(){
			access($this->param->isMember && $this->param->member->level == "N","일반회원만 접근 가능합니다.",HOME."/main");
			$this->franList = $this->model->getFranList();
			if(isset($_GET['idx'])) $this->checkedFran = $this->model->getFran();
		}

		function menu(){
			$this->reviewCnt = $this->model->rowCount("SELECT * FROM review where fidx = '{$_GET['idx']}'");
			$this->menuList = $this->model->getMenuList();
			if(isset($_SESSION['cart'])){
				$total_price = 0;
				for ($i=0; $i < count($_SESSION['cart']); $i++) { 
					$total_price += $_SESSION['cart'][$i]->total_price;
				}
			}
			$this->total_price = isset($total_price) ? $total_price : 0;
		}

		function cartEmpty(){
			$_SESSION['cart'] = [];
			move(HOME."/order/menu/?idx=".$_GET['idx']);
		}

		function menuBuy(){
			access(count($_SESSION['cart']),"한개 이상의 메뉴를 선택하세요.");
			$menu = "";
			$quantity = "";
			$price = "";
			$total_price = 0;
			for ($i=0; $i < count($_SESSION['cart']); $i++) { 
				$menu .= "/ {$_SESSION['cart'][$i]->menu}";
				$quantity .= "/ {$_SESSION['cart'][$i]->quantity}";
				$price .= "/ {$_SESSION['cart'][$i]->total_price}";
				$total_price += $_SESSION['cart'][$i]->total_price;
				$this->model->query("UPDATE menu SET quantity = '{$_SESSION['cart'][$i]->quantity}' where fidx = '{$_GET['idx']}' and name = '{$_SESSION['cart'][$i]->menu}'");
			}
			$menu = substr($menu,2);
			$quantity = substr($quantity,2);
			$price = substr($price,2);
			$sql = "INSERT INTO deliveryorder SET midx = '{$this->param->member->idx}', fidx = '{$_GET['idx']}', date = now(), price = '{$price}', quantity = '{$quantity}', menu = '{$menu}', total_price = '{$total_price}'";
			$_SESSION['cart'] = [];
			access(!$this->model->query($sql),"결제되었습니다",HOME."/order/order");
		}

		function cartChange(){
			$cart = $_SESSION['cart'];
			$_SESSION['cart'] = [];
			for ($i = 0; $i < count($cart) ; $i++) {
				if($i == $_GET['i']) continue;
				$_SESSION['cart'][] = $cart[$i];
			}
			move(HOME."/order/menu/?idx=".$_GET['idx']);
		}

		function details(){
			access($this->param->isMember && $this->param->member->level == "N" || $this->param->member->level == "N","일반회원 또는 관리자만 접근가능합니다.",HOME."/main");
			$this->orderList = $this->model->getOrderList();
			$this->total_price = 0;
			foreach ($this->orderList as $data) {
	            $priceArr = explode("/",$data->price);
	            for($j = 0; $j < count($priceArr); $j++) $this->total_price += $priceArr[$j];
			}
			if($this->param->member->level == "AD") $this->memberList = $this->model->getMemberList();
		}

		function review(){
			$this->reviewList = $this->model->getReviewList();
		}
	}