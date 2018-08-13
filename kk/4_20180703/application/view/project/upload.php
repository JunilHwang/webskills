<!-- main section -->
<section id="main">
	<!-- container -->
	<div class="container">

		<div class="row">
			<h4>Upload</h4>
		</div>
		<div class="row">
			<div class="card">
				<div class="codeview fixed-footer">
					<div class="head">
						<div class="title">File Upload</div>
						<div class="blank"></div>
					</div>
					<div class="divider"></div>
					<div class="card-content">
						<form id="newproject" action="<?php echo $actionURI?>" method="post" enctype="multipart/form-data">
							<div class="file-field input-field">
								<div class="btn">
									<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;File&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<input type="file" name="file" required>
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text">
								</div>
							</div>
							<div class="input-field padding center">
								<button type="submit" class="waves-effect waves-light btn modal-trigger blue lighten-1">
									<i class="material-icons">file_upload</i>
									upload
								</button>
								<button type="button" class="waves-effect waves-light btn modal-trigger red lighten-1" onclick="history.back(); return false;">
									<i class="material-icons">highlight_off</i>
									Cancel
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- container -->
</section>
<!-- main section -->