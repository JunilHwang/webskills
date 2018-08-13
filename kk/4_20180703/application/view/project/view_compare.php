<div id="compare"<?php if($isCompare) echo ' class="active"' ?>>
	<div class="card">
		<?php
			include_once(_VIEW."/project/view_compare_header.php");
		?>

		<div class="collection tab-content">
			<?php
			if ($isCompare) {
				if ($param->file != $data->root) {
			?>
			<a class="collection-item" href="<?php echo "{$currentURI}/{$parentIdx}?from={$param->compareFrom}"?>">..</a>
			<?php
				}
				foreach ($compareList[0] as $key=>$compareData) {
					$diffIdx = $compareData->compare == 0
							   ? $compareData->prev_data->idx
							   : null;
					$link = $compareData->compare > -1
							? preg_replace("/(.*){{now_data}}(.*){{compareFile}}/", '${1}'.$compareData->now_data->idx.'${2}'.$diffIdx, $dir_base)
							: '#!';
					$compareType = "";
					switch ($compareData->compare) {
						case '1' : $compareType = " insert"; break;
						case '-1' : $compareType = " delete"; break;
					}
			?>
			<a class="collection-item<?php echo $compareType?>" href="<?php echo $link?>">
				<i class="material-icons">folder</i>
				<?php echo $key?>
			</a>			
			<?php
				} foreach ($compareList[1] as $key=>$compareData) {
					$diffIdx = $compareData->compare == 0
							   ? $compareData->prev_data->idx
							   : null;
					$file_link = $compareData->compare > -1
								 ? preg_replace("/(.*){{now_data}}(.*){{compareFile}}/", '${1}'.$compareData->now_data->idx.'${2}'.$diffIdx, $file_base)
								 : '#!';
					$compareType = "";
					switch ($compareData->compare) {
						case '1' : $compareType = " insert"; break;
						case '-1' : $compareType = " delete"; break;
					}
			?>
			<a class="collection-item<?php echo $compareType?>" href="<?php echo $file_link?>">
				<i class="material-icons">insert_drive_file</i>
				<?php echo $key?>
			</a>
			<?php }
			} ?>
		</div>

	</div>
</div>