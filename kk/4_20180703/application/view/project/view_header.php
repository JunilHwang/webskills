<div class="card manager-header">
	<div class="container">
		<div class="projecttitle"><a href="<?php echo $mainURI?>"><?php echo $projectTitle?></a></div>
		<p><?php echo $data->description?></p>
	</div>
	<div class="divider"></div>
	<div class="container">
		<ul class="tabs row">
			<li class="tab col"><a href="#code">code</a></li>
			<li class="tab col"><a href="#version">versions</a></li>
			<?php if (sizeOf($versionList) > 1): ?>
			<li class="tab col"><a href="#compare"<?php if($isCompare) echo ' class="active"' ?>>Compare</a></li>
			<?php endif ?>
		</ul>
	</div>
</div>	