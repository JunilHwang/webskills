<h2 class="content-title">관광지 리뷰</h2>
<?php if ($param->isMember) { ?>
<div class="row">
    <div class="right">
        <a href="<?php echo "{$param->get_page}/write"?>" class="btn blue layerOpener">리뷰 작성</a>
    </div>
</div>
<?php } ?>
<div class="row">
    <?php foreach ($list as $data): ?>
    <article class="card review">
        <a href="<?php echo "{$param->get_page}/view/{$data->idx}"?>" class="mask layerOpener"></a>
        <div class="img_wrap<?php echo isset($data->uri) ? '' :' none'?>" style="background-image:url(<?php echo isset($data->uri) ? $data->uri : IMG_URL."/logo.png"?>)"></div>
        <div class="info">
            <h3 class="subject"><?php echo $data->subject?></h3>
            <p class="destination">관광지 : <?php echo $data->dname?></p>
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
    </article>
    <?php endforeach ?>
</div>
<?php if(count($list)) echo $paginate?>
<script type="text/javascript" src="<?php echo SRC_URL?>/se2/js/HuskyEZCreator.js"></script>