<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Project Manager</title>
	<link rel="stylesheet" type="text/css" href="<?php echo SRC_URL?>/materialize/css/materialize.css">
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL?>/style.css">
	<script type="text/javascript" src="<?php echo JS_URL?>/jquery.js"></script>
	<script type="text/javascript" src="<?php echo SRC_URL?>/materialize/js/materialize.min.js"></script>
</head>
<body class="blue-grey lighten-5">

	<!-- header -->
	<nav class="blue lighten-2">
		<!-- container -->
		<div class="container">
			<div class="nav-wrapper">

				<!-- title -->
				<a class="brand-logo center" href="<?php echo URL?>">project manager</a>

				<!-- menu icon -->
				<?php if($this->param->isMember) { ?>
				<ul class="left">
					<li data-target="sidenav" class="sidenav-trigger">
						<a href="#" class="not"><i class="material-icons small">menu</i></a>
					</li>
				</ul>
				<?php } ?>

				<!-- navigation buttons -->
				<ul class="right">
					<?php if ($this->param->isMember) { ?>
					<li>
						<a href="<?php echo URL ?>/member/logout">Logout</a>
					</li>
					<?php } else { ?>
					<li>
						<a href="<?php echo URL ?>/member/login">Login</a>
					</li>
					<li>
						<a href="<?php echo URL ?>/member/join">Sign In</a>
					</li>
					<?php } ?>
				</ul>

			</div>
		</div>
		<!-- container -->
	</nav>
	<!-- header -->