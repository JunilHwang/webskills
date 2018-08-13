<h3><?php echo $path_name?></h3>
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
			<th>파일 / 디렉토리명</th>
			<th>크기</th>
			<th>종류</th>
			<th>생성일</th>
			<th>수정일</th>
			<th>기능</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($path != 0): ?>
		<tr>
			<td colspan="6"><a href="<?php echo $parentURL?>">..</a></td>
		</tr>
		<?php endif ?>
		<?php foreach ($dir_list as $key => $data): ?>
		<tr>
			<td colspan="2"><a href="<?php echo HOME_URL?>/file?path=<?php echo $data->idx?>"><?php echo $data->com_name?></a></td>
			<td>폴더</td>
			<td><?php echo $data->create_date?></td>
			<td><?php echo $data->change_date?></td>
			<td>
				<button type="button" onclick="location.href = '<?php echo HOME_URL?>/file/update/<?php echo $data->idx?>'; return false;">이름변경</button>
				<button type="button" onclick="location.href = '<?php echo HOME_URL?>/file/deletePath/<?php echo $data->idx?>'; return false;">삭제</button>
			</td>
		</tr>
		<?php endforeach ?>
		<?php foreach ($file_list as $key => $data): ?>
		<tr>
			<td><a href="<?php echo HOME_URL?>/down?idx=<?php echo $data->idx?>"><?php echo $data->com_name?></a></td>
			<td><?php echo get_mb($data->size)?></td>
			<td>파일</td>
			<td><?php echo $data->create_date?></td>
			<td><?php echo $data->change_date?></td>
			<td>
				<button type="button" onclick="if(!confirm('내부 인원에게 공유하시겠습니까?')) return false; location.href = '<?php echo HOME_URL?>/share/in/<?php echo $data->idx?>'; return false;">내부공유</button>
				<button type="button" onclick="location.href = '<?php echo HOME_URL?>/share/out/<?php echo $data->idx?>'; return false;">외부공유</button>
				<button type="button" onclick="location.href = '<?php echo HOME_URL?>/file/update/<?php echo $data->idx?>'; return false;">이름변경</button>
				<button type="button" onclick="location.href = '<?php echo HOME_URL?>/file/deleteFile/<?php echo $data->idx?>'; return false;">삭제</button>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>

<button type="button" onclick="location.href = '<?php echo HOME_URL?>/file/dir_add?path=<?php echo $path ?>'">디렉토리 생성</button>
<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="action" value="file_upload">
	<input type="hidden" name="parent" value="<?php echo $path?>">
	<label> 파일 선택 : 
		<input type="file" name="file">
	</label>
	<button type="submit">업로드</button>
</form>