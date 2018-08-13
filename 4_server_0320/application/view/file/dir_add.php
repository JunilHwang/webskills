<h3><?php echo $path_name?> : 디렉토리 추가</h3>
<form action="" method="post">
	<fieldset>
		<legend>추가하기</legend>
		<input type="hidden" name="action" value="dir_add">
		<ul>
			<li>
				<label>
					이름 : 
					<input type="text" name="com_name" size="20" autofocus="" placeholder="디렉토리 이름을 입력해주세요.">
				</label>
			</li>
		</ul>
		<button type="submit">추가하기</button>
		<button type="button" onclick="history.back(); return false;">취소</button>
	</fieldset>
</form>