<div id="contents">
    <div class="wrap">
        <div class="page-title">
            <h2><?php echo $board_set->name?></h2>
        </div>
        <span class="b_cnt">전체 : <b><?php echo count($board)?></b></span>
        <?php
            switch ($board_set->type) {
                case '1' :
        ?>
        <table class="n_board">
            <colgroup>
                <col style="auto;">
                <col style="width:50%;">
                <col style="auto;">
                <col style="auto;">
            </colgroup>

            <thead>
                <tr>
                    <th>번호</th>
                    <th>제목</th>
                    <th>작성자</th>
                    <th>작성일시</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($board as $data): ?>
                <tr>
                    <td><?php echo $data->idx?></td>
                    <td><a href="<?php echo HOME_URL."/board/view/{$data->idx}?menu={$param->idx}&amp;bsidx={$board_set->idx}"?>"><?php echo $data->title?></a></td>
                    <td><?php echo $data->writer?></td>
                    <td><?php echo $data->datetime?></td>
                </tr>                   
                <?php endforeach ?>
            </tbody>
        </table>

        <?php
                break;
                case '2' :
        ?>
        <div class="b_board">
            <ul>
                <?php foreach ($board as $data): ?>
                <li>
                    <?php $file = json_decode($data->file); ?>
                    <?php if ($file != '') { ?>
                    <span class="img-area">
                        <img src="<?php echo UP_URL."/{$file[0]}"?>" alt="<?php echo $data->title?>">
                    </span>
                    <?php } else { ?>
                    <span class="no-img">
                        No Image
                    </span>
                    <?php } ?>

                    <div class="l-info">
                        <h3><a href="<?php echo HOME_URL."/board/view/{$data->idx}?menu={$param->idx}&amp;bsidx={$board_set->idx}"?>"><?php echo $data->title?></a></h3>
                        <h5><?php echo $data->datetime?></h5>
                        <p><?php echo \App\Core\text_cut($data->text, 100);?></p>
                    </div>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
        <?php
                break;
                case '3' :
        ?>
        <div class="c_board">
            <ul>
                <?php foreach ($board as $data): ?>
                <li style="width:<?php echo 100 / $board_set->line_cnt?>%;">
                    <div class="box">
                        <?php $file = json_decode($data->file); ?>
                        <?php if ($file != '') { ?>
                        <div class="img" style="height:300px;background:url('<?php echo UP_URL."/{$file[0]}"?>') no-repeat center / cover;"></div>
                        <?php } else { ?>
                        <div class="no-image img" style="display:none;" >
                            <p>No Image</p>
                        </div>
                        <?php } ?>
                        <span class="b-no"><?php echo $data->idx?></span>
                        <h3><a href="<?php echo HOME_URL."/board/view/{$data->idx}?menu={$param->idx}&amp;bsidx={$board_set->idx}"?>"><?php echo $data->title?></a></h3>
                        <p class="bd-from"><?php echo $data->writer?></p>
                        <ul>
                            <li>일시 <span><?php echo $data->datetime?></span></li>
                            <li>조회 <span><?php echo $data->hit?></span></li>
                        </ul>
                    </div>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
        <?php
                break;
            }
        ?>
        <div class="write-btn">
            <button type="button" onclick="location.href = '<?php echo HOME_URL."/board/write?menu={$param->idx}&amp;bsidx={$board_set->idx}"?>'">글쓰기</button>
        </div>
        <div class="page_nation" style="clear:both;">
            <?php echo $page_nation?>
        </div>
    </div>
</div>