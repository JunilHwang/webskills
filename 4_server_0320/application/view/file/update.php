<h3><?php echo $path_name?> : 디렉토리 / 파일 이름 수정</h3>
<form action="" method="post">
	<fieldset>
		<legend>이름 변경</legend>
		<input type="hidden" name="action" value="update">
		<?php if ($data->type != 'path'): ?>
		<input type="hidden" name="ext" value=".<?php echo $ext;?>">
		<?php endif ?>
		<ul>
			<li>
				<label>
					이름 : 
					<input type="text" name="com_name" size="80" value="<?php echo $data->com_name?>" autofocus="" placeholder="디렉토리 이름을 입력해주세요.">
				</label>
			</li>
		</ul>
		<button type="submit">수정완료</button>
		<button type="button" onclick="history.back(); return false;">취소</button>
	</fieldset>
</form>