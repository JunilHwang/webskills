<?php
$data = fetch("SELECT change_name FROM files where idx='{$idx}'");
@unlink(DATA_PATH."/{$data->change_name}");
$sql = "DELETE FROM files where idx='{$idx}'";
query($sql);
alert("삭제 되었습니다.");
move();