<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta http-equiv="Content-Language" content="en" />
    <title>우리동네배달</title>
    <script type="text/javascript" src="<?php echo JS_URL ?>/jquery/jquery-3.3.1/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="<?php echo JS_URL ?>/jquery/jquery-ui-1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo JS_URL ?>/bootstrap-4.1.1-dist/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo JS_URL ?>/script.js"></script>
    <link href="<?php echo JS_URL ?>/jquery/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet" />
    <link href="<?php echo CSS_URL ?>/dashboard.css" rel="stylesheet" />
  </head>
  
  <body>
    <div class="page">
      <div class="page-main">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex text-center">
              <a class="header-brandm col-12" href="<?php echo HOME ?>/main">
                <img src="<?php echo IMG_URL ?>/logo.png" class="header-brand-img" alt="우리동네배달">
              </a>
            </div>
          </div>
        </div>
        <div class="header d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-lg-row">

                  <li class="nav-item">
                    <a href="<?php echo HOME ?>/main" class="nav-link <?php if($this->param->include_file == "main") echo 'active'; ?>"><i class="fe fe-home"></i> Home</a>
                  </li>
            <?php if($this->param->isMember): ?>
                  <li class="nav-item">
                    <a href="<?php echo HOME ?>/member/logout" class="nav-link"><i class="fe fe-log-out"></i> 로그아웃</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo HOME ?>/member/myinfomodify" class="nav-link" <?php if($this->param->include_file == "myinfomodify") echo 'active'; ?>><i class="fe fe-user-plus"></i> 내 정보변경</a>
                  </li>
            <?php else: ?>
                  <li class="nav-item">
                    <a href="<?php echo HOME ?>/member/login" class="nav-link <?php if($this->param->include_file == "login") echo 'active'; ?>"><i class="fe fe-log-in"></i> 로그인</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo HOME ?>/member/join" class="nav-link <?php if($this->param->include_file == "join") echo 'active'; ?>"><i class="fe fe-home"></i> 회원가입</a>
                  </li>
            <?php endif ?>
                  <li class="nav-item">
                    <a href="<?php echo HOME ?>/order/order" class="nav-link <?php if($this->param->include_file == "order") echo 'active'; ?>"><i class="fe fe-home"></i> 주문하기</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo HOME ?>/order/details" class="nav-link <?php if($this->param->include_file == "details") echo 'active'; ?>"><i class="fe fe-home"></i> 주문내역</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo HOME ?>/admin/affiliation" class="nav-link <?php if($this->param->include_file == "affiliation") echo 'active'; ?>"><i class="fe fe-home"></i> 가맹회원</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="my-3 my-md-5">
          <div class="container">