<h3>외부 공유 목록</h3>
<table width="100%" border="1">
	<colgroup>
		<col width="30%">
		<col width="10%">
		<col width="10%">
		<col width="15%">
		<col width="15%">
		<col width="20%">
	</colgroup>
	<thead>
		<tr>
			<th>파일명</th>
			<th>파일용량</th>
			<th>공유자(이름/아이디)</th>
			<th>공유일</th>
			<th>다운로드 횟수</th>
			<th>다운로드 주소</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($list as $key => $data): ?>
		<tr>
			<td><a href="<?php echo HOME_URL?>/?q=<?php echo $data->ukey?>"><?php echo $data->file_name?></a></td>
			<td><?php echo get_mb($data->file_size)?></td>
			<td><?php echo "{$data->member_name}($data->member_id)"?></td>
			<td><?php echo $data->regdate?></td>
			<td><?php echo $data->cnt?></td>
			<td>
				<a href="<?php echo HOME_URL?>/?q=<?php echo $data->ukey?>">
					<?php
						echo $_SERVER['REQUEST_SCHEME']."://";
						echo $_SERVER['HTTP_HOST'];
						echo HOME_URL."/?q={$data->ukey}";
					?>
				</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>