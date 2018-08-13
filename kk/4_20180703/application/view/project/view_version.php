<div id="version">
	<div class="card">
		<div class="collection tab-content">
			<?php foreach ($versionList as $versionData): ?>
			<div class="collection-item">
				<a class="title" href="<?php echo "{$param->get_page}/view/{$param->idx}/{$versionData->version}/{$versionData->root}"?>"><?php echo $versionData->title?></a>
				<div><?php echo $versionData->description?></div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>