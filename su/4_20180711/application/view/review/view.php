<div class="review-detail">
    <ul>
        <li class="row">
            <div class="review-title">
                <h4 class="subject"><?php echo $data->subject?></h4>
                <p>
                    <span class="writer">
                        <i class="material-icons tiny">brush</i>
                        <?php echo $data->writer_name?>
                    </span>
                    <span class="date">
                        <i class="material-icons tiny">access_time</i>
                        <?php echo substr($data->date, 0, 16)?>
                    </span>
                </p>
            </div>
        </li>
        <?php if (isset($data->uri)) { ?>
        <li class="row">
            <div class="img_wrap"><img src="<?php echo $data->uri?>" alt="<?php echo $data->origin?>"></div>
        </li>
        <?php } ?>
        <li class="row">
            <?php echo $data->content ?>
        </li>
        <li class="row">
            <div class="center">
                <?php if ($param->isMember && $param->member->idx == $data->writer) { ?>
                <a href="<?php echo "{$param->get_page}/update/{$param->idx}"?>" class="light-blue darken-3 waves-effect waves-light btn-small layerOpener">수정</a>
                <a href="<?php echo "{$param->get_page}/delete/{$param->idx}"?>" class="light-blue darken-3 waves-effect waves-light btn-small">삭제</a>
                <?php } ?>
                <a href="#!" class="light-blue waves-effect waves-light btn-small layer_close">닫기</a>
            </div>
        </li>
    </ul>
</div>