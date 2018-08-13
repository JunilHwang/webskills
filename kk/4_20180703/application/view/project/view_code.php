<div id="code">
	<div class="card">
		<form action="" method="post">
			<input type="hidden" name="action" value="file_multi_delete">
			<div class="btn_group">
				<a class="waves-effect waves-light btn" href="<?php echo $downURI?>"><i class="material-icons">file_download</i>download</a>
				<?php if ($isWriter && $data->version == $param->version) { ?>
				<a class="waves-effect waves-light btn modal-trigger blue lighten-1" href="<?php echo $uploadURI?>">
					<i class="material-icons">file_upload</i>
					upload
				</a>
				<a class="waves-effect waves-light btn modal-trigger green lighten-1" href="<?php echo $commitURI?>">
					<i class="material-icons">done</i>
					commit
				</a>
				<button class="waves-effect waves-light btn modal-trigger right red lighten-1" type="submit">
					<i class="material-icons">delete</i>
					delete
				</button>
				<?php } ?>
			</div>

			<div class="divider"></div>

			<div class="collection tab-content">
				<?php if ($param->file != $data->root): ?>
				<a class="collection-item" href="<?php echo "{$currentURI}/{$parentIdx}"?>">..</a>
				<?php endif ?>
				<?php foreach ($fileList as $key => $fileData): ?>
				<?php if ($fileData->type == 'dir'): ?>
				<a class="collection-item" href="<?php echo "{$currentURI}/{$fileData->idx}"?>">
					<label class="left">
						<input type="checkbox" name="idx[]" value="<?php echo $fileData->idx?>"><span></span>
					</label>
					<i class="material-icons">folder</i>
					<?php echo $fileData->name?>
				</a>						
				<?php else: ?>
				<a class="collection-item" href="<?php echo "{$fileURI}/{$fileData->idx}"?>">
					<label class="left">
						<input type="checkbox" name="idx[]" value="<?php echo $fileData->idx?>"><span></span>
					</label>
					<i class="material-icons">insert_drive_file</i>
					<?php echo $fileData->name?>
				</a>						
				<?php endif ?>
				<?php endforeach ?>
			</div>
		</form>

	</div>
</div>