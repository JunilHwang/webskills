<div id="compare"<?php if($isCompare) echo ' class="active"' ?>>
	<div class="card">
		<?php
			include_once(_VIEW."/project/view_compare_header.php");
		?>

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