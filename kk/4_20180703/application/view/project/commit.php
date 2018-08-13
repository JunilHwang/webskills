<!-- main section -->
<section id="main">
	<!-- container -->
	<div class="container">

		<div class="row">
			<h4>Project Commit</h4>
		</div>
		<div class="row">
			<div class="card">
				<div class="codeview fixed-footer">
					<div class="head">
						<div class="title">Commit</div>
						<div class="blank"></div>
					</div>
					<div class="divider"></div>
					<div class="card-content">
						<form id="newproject" action="" method="post" enctype="multipart/form-data">
							<input type="hidden" name="action" value="version_insert">
							<div class="input-field">
								<input type="text" id="title" name="title" autocomplete="off" required>
								<label for="title">title</label>
							</div>
							<div class="input-field">
								<input type="text" id="description" name="description" autocomplete="off" required>
								<label for="description">description</label>
							</div>
							<div class="input-field padding center">
								<button type="submit" class="waves-effect waves-light btn modal-trigger green lighten-1">
									<i class="material-icons">done</i>
									commit
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