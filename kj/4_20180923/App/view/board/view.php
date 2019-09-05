<div id="contents" class="bd-view">
    <div class="wrap">
        <div class="page-title">
            <h2><?php echo $board_set->name?></h2>
        </div>

        <div class="bd-title">
            <h5>No. <?php echo $data->idx?></h5>
            <h3><?php echo $data->title?></h3>
        </div>

        <div class="bd-text">
            <?php $file = json_decode($data->file); ?>
            <?php if ($data->file != '') { ?>
            <div class="img-area"><img src="<?php echo UP_URL.'/'.$file[0]?>"></div>
            <?php } ?>
            <div class="text"><?php echo nl2br($data->text)?></div>
        </div>

        <div class="bd-info">
            <p class="username"><b>작성자</b> : <?php echo $data->writer?></p>
            <p class="date"><b>작성일시</b> : <?php echo $data->datetime?></p>

            <p class="hit"><b>조회수</b> : <?php echo $data->hit?></p>
        </div>

        <div class="file-l">
            <span>첨부파일</span>

            <ul>
                <?php if ($file != '') foreach ($file as $f) { ?>
                <li><a href="<?php echo UP_URL."/{$f}"?>" download><?php echo $f?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="write-btn">
            <button type="button" onclick="location.href = '<?php echo $param->get_page."/modify/{$param->idx}?bsidx={$_GET['bsidx']}"?>'">수정</button>
            <button type="button" onclick="location.href = '<?php echo $param->get_page."/delete/{$param->idx}?bsidx={$_GET['bsidx']}"?>'">삭제</button>
            <button type="button" onclick="history.back();">목록</button>
        </div>
    </div>
</div>