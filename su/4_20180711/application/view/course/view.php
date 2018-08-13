<div class="course-detail">
    <div class="detail-title">
        <h4><?php echo $data->subject?></h4>
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
    <?php if (isset($data->uri)) { ?>
    <div class="row">
        <div class="img_wrap"><img src="<?php echo $data->uri ?>" alt="<?php echo $data->origin?>"></div>
    </div>
    <?php } ?>
    <div class="row">
        <ul class="path">
            <li>
                <strong class="lbl">[대중교통]</strong>
                <div class="desc">
                    <span class="list">
                        <?php
                            $label = $path[0]->label;
                            $cost = $path[0]->cost;
                            $i = 0;
                            echo $label[$i];
                            while (++$i < $path_length) {
                                echo ' <i class="material-icons">navigate_next</i> ';
                                echo ' <span class="cost">'.$cost[$i-1].' 분</span> ';
                                echo $label[$i];
                            }
                        ?>
                    </span>
                    <span class="total_cost">
                        <?php echo $path[0]->total?>분 소요
                    </span>
                </div>
            </li>
            <li>
                <strong class="lbl">[자가용]</strong>
                <div class="desc">
                    <span class="list">
                        <?php
                            $label = $path[1]->label;
                            $cost = $path[1]->cost;
                            $i = 0;
                            echo $label[$i];
                            while (++$i < $path_length) {
                                echo ' <i class="material-icons">navigate_next</i> ';
                                echo ' <span class="cost">'.$cost[$i-1].' 분</span> ';
                                echo $label[$i];
                            }
                        ?>
                    </span>
                    <span class="total_cost">
                        <?php echo $path[1]->total?>분 소요
                    </span>
                </div>
            </li>
            <li>
                <strong class="lbl">[대중교통 최단]</strong>
                <div class="desc">
                    <span class="list">
                        <?php
                            $label = $path_shortest[0]->label;
                            $cost = $path_shortest[0]->cost;
                            $i = 0;
                            echo $label[$i];
                            while (++$i < $path_length) {
                                echo ' <i class="material-icons">navigate_next</i> ';
                                echo ' <span class="cost">'.$cost[$i-1].' 분</span> ';
                                echo $label[$i];
                            }
                        ?>
                    </span>
                    <span class="total_cost">
                        <?php echo $path_shortest[0]->total?>분 소요
                    </span>
                </div>
            </li>
            <li>
                <strong class="lbl">[자가용 최단]</strong>
                <div class="desc">
                    <span class="list">
                        <?php
                            $label = $path_shortest[1]->label;
                            $cost = $path_shortest[1]->cost;
                            $i = 0;
                            echo $label[$i];
                            while (++$i < $path_length) {
                                echo ' <i class="material-icons">navigate_next</i> ';
                                echo ' <span class="cost">'.$cost[$i-1].' 분</span> ';
                                echo $label[$i];
                            }
                        ?>
                    </span>
                    <span class="total_cost">
                        <?php echo $path_shortest[1]->total?>분 소요
                    </span>
                </div>
            </li>
        </ul>
    </div>
    <div class="row detail-content"><?php echo $data->content?></div>
    <div class="row">
        <div class="center">
            <?php if ($param->isMember && $param->member->idx == $data->writer) { ?>
            <a href="<?php echo "{$param->get_page}/update/{$param->idx}"?>" class="light-blue darken-3 waves-effect waves-light btn-small layerOpener">수정</a>
            <a href="<?php echo "{$param->get_page}/delete/{$param->idx}"?>" class="light-blue darken-3 waves-effect waves-light btn-small">삭제</a>
            <?php } ?>
            <a href="#!" class="light-blue waves-effect waves-light btn-small layer_close">닫기</a>
        </div>
    </div>
</div>