<div id="contents">
    <div class="banner">
        <div class="banner-img">
            <div class="left-back" style="background-color:#<?php echo $ani->left_back?>;"></div>
            <ul style="width: 100%; margin-left: 0%;">
                <?php foreach ($ani->m_img as $img): ?>
                <li style="background:url('<?php echo UP_URL?>/<?php echo $img->saved_name?>') no-repeat center / cover"></li>
                <?php endforeach ?>
            </ul>
            <div class="right-back" style="background-color:#<?php echo $ani->right_back?>;"></div>

            <div class="banner-pos">
                <ul>

                </ul>
            </div>
        </div>
    </div>


    <div id="section">
        <div class="wrap">
            <?php foreach ($content_meta as $dep1): ?>
            <div class="section" style="width:100%;">
                <?php foreach ($main_content[$dep1->idx] as $dep2):?>
                <?php if ($dep2->bidx == 0) { ?>
                <div class="banner-img" style="width:<?php echo 100 / count($main_content)?>%;" onmouseenter="$('.def_i',this).hide(); $('.over_i', this).show();" onmouseleave="$('.def_i',this).show(); $('.over_i', this).hide();">
                    <img src="<?php echo IMG_URL?>/13_1.jpg" alt="def" class="def_i">
                    <img src="<?php echo IMG_URL?>/img1.jpg" alt="over" class="over_i" style="display:none;">
                </div>
                <?php } else { ?>
                    <?php
                        switch ($board_set[$dep2->idx]->type) {
                            case '1' :
                    ?>
                <div class="board_cont" style="width:<?php echo 100 / count($main_content)?>%;">
                    <div class="title">
                        <h3 style="cursor:pointer;"><?php echo $board_set[$dep2->idx]->name?></h3>
                    </div>

                    <ul>
                        <?php foreach ($board[$dep2->idx] as $data): ?>
                        <li><a href="<?php echo HOME_URL."/board/view/{$data->idx}?bsidx={$board_set[$dep2->idx]->idx}"?>"><span class="a_text"><?php echo $data->title?></span></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                    <?php
                            break;
                            case '2' :
                    ?>
                <div class="b_board" style="width:<?php echo 100 / count($main_content)?>%;">
                    <div class="title">
                        <h3><?php echo $board_set[$dep2->idx]->name?></h3>
                    </div>
                    <ul>
                        <?php foreach ($board[$dep2->idx] as $key => $data): ?>
                            <?php if ($key > 2) break;?>
                            <?php $file = json_decode($data->file); ?>
                            <?php $img = isset($file[0]) ? $file[0] : '' ?>
                        <li>
                            <span class="img-area" style="background:url('<?php echo UP_URL.'/'.$img?>') no-repeat center / cover"></span>
                            <div class="l-info">
                                <h3><a href="<?php echo HOME_URL."/board/view/{$data->idx}?bsidx={$board_set[$dep2->idx]->idx}"?>"><?php echo $data->title?></a></h3>
                                <p><?php echo \App\Core\text_cut($data->text, 20);?></p>
                            </div>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
                    <?php
                            break;
                            case '3' :
                    ?>
                <div class="c_board" style="width:<?php echo 100 / count($main_content)?>%;">
                    <div class="title">
                        <h3><?php echo $board_set[$dep2->idx]->name?></h3>
                    </div>
                    <ul>
                        <?php foreach ($board[$dep2->idx] as $key => $data): ?>
                        <?php if ($key > 3) break;  ?>
                        <?php $file = json_decode($data->file); ?>
                        <?php $img = isset($file[0]) ? $file[0] : '' ?>
                        <li style="width:33.33%;">
                            <div class="box">
                                <div class="img" style="background:url(<?php echo UP_URL.'/'.$img?>) no-repeat center / cover;"></div>
                                <h3><a href="<?php echo HOME_URL."/board/view/{$data->idx}?bsidx={$board_set[$dep2->idx]->idx}"?>"><?php echo $data->title?></a></h3>
                                <ul>
                                    <li>일시 <span><?php echo date("Y-m-d", strtotime($data->datetime))?></span></li>
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
                    }
                    ?>
                <?php endforeach ?>
            </div>
            <?php endforeach ?>
            </div>
        </div>
    </div>
</div>