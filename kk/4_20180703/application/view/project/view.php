<!-- main section -->
<section id="main">
	<?php include_once(_VIEW."/project/view_header.php"); ?>
	<div class="container">

		<?php include_once(_VIEW."/project/view_code.php") ?>

		<?php include_once(_VIEW."/project/view_version.php"); ?>

		<?php if(sizeOf($versionList) > 1) include_once(_VIEW."/project/view_compare.php"); ?>

		<!-- tab contents -->
	</div>
</section>
<!-- main section -->