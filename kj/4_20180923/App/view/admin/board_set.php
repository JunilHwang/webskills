<div id="contents" class="board-set"<?php echo $param->menu_toggle ? ' style="margin-top:160px;"' : '메뉴 열어두기'?>>
    <div class="wrap">
        <div class="page-title">
            <h3>게시판 설정</h3>
        </div>

        <div class="board-cnt">
            <h5>게시판</h5>
        </div>

        <div class="board-table">
            <table>
                <colgroup>
                    <col style="width:15%">
                    <col style="width:50%">
                    <col style="width:15%">
                    <col style="width:20%">
                </colgroup>
                <thead>
                    <tr>
                        <th>게시판 이름</th>
                        <th>게시글 총개수</th>
                        <th>수정/삭제</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $data): ?>
                    <tr>
                        <td><?php echo $data->name?></td>
                        <td><?php echo $data->cnt?></td>
                        <td>
                            <a href="<?php echo "{$param->get_page}/board_set_modify/{$data->idx}"?>">수정</a> /
                            <a href="<?php echo "{$param->get_page}/board_set_delete/{$data->idx}"?>">삭제</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="save-btn">
            <button type="button" onclick="location.href = '<?php echo $param->get_page?>/board_set_add'; return false;">게시판 생성</button>
        </div>
    </div>
</div>