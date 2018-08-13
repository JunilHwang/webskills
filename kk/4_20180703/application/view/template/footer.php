	<!-- footer -->
	<footer class="page-footer blue lighten-2">
		<!-- container -->
		<div class="container">
			<div class="row">
				<div class="col m12">
					<h5 class="white-text">Contact</h5>
					<ul>
						<li><a class="grey-text text-lighten-3" href="#">Project@manager.net</a></li>
						<li><a class="grey-text text-lighten-3" href="#">6501-0654</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				<span class="left">Copyright 2018 ProjectManager All rights reserved.</span>
				<span class="right">Powered By MaterializeCss</span>
			</div>
		</div>
		<!-- container -->
	</footer>
	<!-- footer -->

	<?php if ($this->param->isMember): ?>
	<!-- side navigation -->
	<ul id="sidenav" class="sidenav">
		<li>
			<div class="user-view">
				<div class="background">
					<img src="<?php echo IMG_URL?>/user-back.png">
				</div>
				<a href="#user"><img class="circle" src="<?php echo IMG_URL?>/user.png"></a>
				<a href="#name"><span class="white-text name"><?php echo $this->param->member->name?></span></a>
				<a href="#email"><span class="white-text email"><?php echo $this->param->member->email?></span></a>
			</div>
		</li>
		<li>
			<a href="#newproject" class="modal-trigger not"><i class="material-icons">add</i>New Project</a>
		</li>
	</ul>
	<!-- side navigation -->

	<!-- new project form -->
	<form id="newproject" class="modal" action="<?php echo URL?>/project" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value="insert">
		<div class="modal-content">
			<h4>New Project</h4>
			<p>&nbsp;</p>
			<div class="input-field">
				<input type="text" id="title" name="title" autocomplete="off" required>
				<label for="title">title</label>
			</div>
			<div class="input-field">
				<input type="text" id="description" name="description" autocomplete="off" required>
				<label for="description">description</label>
			</div>
			<div class="file-field input-field">
				<div class="btn">
					<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;File&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					<input type="file" name="project" required>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>
		</div>
		<div class="modal-footer input-field">
			<button href="#!" class="modal-action waves-effect waves-green btn-flat">CREATE</button>
		</div>
	</form>
	<!-- new project form -->
	<?php endif ?>

	<script type="text/javascript" src="<?php echo JS_URL?>/app.js"></script>
</body>
</html>