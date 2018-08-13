<!-- main section -->
<section id="main">
	<?php include_once(_VIEW."/project/view_header.php"); ?>
	<div class="container">

		<div id="code">
			<div class="card">

				<div class="codeview">

					<div class="head">
						<div class="title"><?php echo $filePath?></div>
						<div class="blank"></div>
						<a class="grey-text waves-effect waves-red" href="<?php echo $deleteURI?>"><i class="material-icons">delete</i></a>
					</div>

					<div class="divider"></div>

					<div class="card-content">
						<?php echo $fileContent ?>
					</div>

				</div>

			</div>
		</div>

		<?php include_once(_VIEW."/project/view_version.php") ?>

		<?php if(sizeOf($versionList) > 1) include_once(_VIEW."/project/view_compare_file.php") ?>

		<!-- tab contents -->
	</div>
</section>
<!-- main section -->