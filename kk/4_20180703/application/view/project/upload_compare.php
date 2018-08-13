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
						<div class="title"><?php echo $fileURI?></div>
						<div class="blank"></div>
					</div>
					<div class="divider"></div>
					<div class="card-content">
						<?php echo $content?>
						<!-- this is <span class="insert">new</span> file1<span class="delete">.txt</span> -->
					</div>
					<div class="card-action">
						<a href="<?php echo "{$param->get_page}/cancel/{$param->idx}/{$param->version}/{$param->file}?uri=".urlencode("{$fileURI}.tmp")?>">cancel</a>
						<a href="<?php echo $uploadURI?>">upload</a>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- container -->
</section>
<!-- main section -->