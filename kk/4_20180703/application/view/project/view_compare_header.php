<form action="" method="post">
	<div class="btn_group row">
		<div class="col select">
			<select name="from">
				<option disabled>choose</option>
				<?php
					$len = sizeof($versionList);
					for ($i = 1; $i < $len; $i++) {
						$versionData = $versionList[$i];
						$sel = '';
						if (isset($param->compareFrom) && $param->compareFrom == $versionData->version)
							$sel = ' selected';
						echo "<option value=\"{$versionData->version}\"{$sel}>{$versionData->title}</option>";
					}
				?>
			</select>								
		</div>
		<div class="col arrow">
			<span class="material-icons">chevron_right</span>
		</div>
		<div class="col select">
			<select name="to">
				<option disabled>choose</option>
				<?php
					for ($i = 0; $i < $len - 1; $i++) {
						$versionData = $versionList[$i];
						$sel = '';
						$title = $versionData->title;
						if ($i == 0) {
							$title = 'current';
						}
						if ($param->version == $versionData->version) {
							$sel = ' selected';
						}
						echo "<option value=\"{$versionData->version}\"{$sel}>{$title}</option>";
					}
				?>
			</select>							
		</div>
		<div class="col">
			<button type="submit" class="btn">compare</button>
		</div>
	</div>
</form>
<div class="divider"></div>