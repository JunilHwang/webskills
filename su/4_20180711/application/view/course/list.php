<h2 class="content-title">추천 코스 여행</h2>
<?php if ($param->isMember) { ?>
<div class="row">
    <div class="right">
        <a href="<?php echo "{$param->get_page}/write"?>" class="btn blue waves-effect waves-light layerOpener">작성</a>
    </div>
</div>
<?php } ?>
<div class="row">
    <?php foreach ($list as $data):
            $path = json_decode($data->list);
            $path_shortest = json_decode($data->shortest_list);
        ?>
    <article class="course">
        <a href="<?php echo "{$param->get_page}/view/{$data->idx}"?>" class="mask layerOpener"></a>
        <div class="img_wrap<?php echo isset($data->uri) ? "" : ' none'?>" style="background-image:url(<?php echo isset($data->uri) ? $data->uri : IMG_URL."/logo.png"?>)"></div>
        <div class="info">
            <h3 class="subject"><?php echo $data->subject?></h3>
            <p class="writer">
                <i class="material-icons tiny">brush</i>
                <?php echo $data->writer_name?>
            </p>
            <ul class="path">
                <li>
                    <strong class="lbl">[사용자 추천]</strong>
                    <div class="desc">
                        <span class="list">
                            <?php echo implode(' <i class="material-icons">navigate_next</i> ', $path[0]->label); ?>
                        </span>
                        <span class="cost">
                            <span>대중교통</span><?php echo $path[0]->total?>분 소요 /
                            <span>자가용</span><?php echo $path[1]->total?>분 소요
                        </span>
                    </div>
                </li>
                <li>
                    <strong class="lbl">[대중교통 최단]</strong>
                    <div class="desc">
                        <span class="list">
                            <?php echo implode(' <i class="material-icons">navigate_next</i> ', $path_shortest[0]->label); ?>
                        </span>
                        <span class="cost">
                            <?php echo $path_shortest[0]->total?>분 소요
                        </span>
                    </div>
                </li>
                <li>
                    <strong class="lbl">[자가용 최단]</strong>
                    <div class="desc">
                        <span class="list">
                            <?php echo implode(' <i class="material-icons">navigate_next</i> ', $path_shortest[1]->label); ?>
                        </span>
                        <span class="cost">
                            <?php echo $path_shortest[1]->total?>분 소요
                        </span>
                    </div>
                </li>
            </ul>
            <p class="description"><?php echo shortContent($data->content, 250)?></p>
        </div>
    </article>
    <?php endforeach ?>
</div>
<?php if (count($list) > 0) echo $paginate; ?>
<script type="text/javascript" src="<?php echo SRC_URL?>/se2/js/HuskyEZCreator.js"></script>