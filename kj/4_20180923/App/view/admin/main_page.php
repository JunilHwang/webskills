
<style>
    .m-cont {
        float: left;
        width: 100%;
        margin-top: 10px;
    }

    .m-cont>li {
        float: left;
        width: 100%;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 15px 20px;
        margin-bottom: 10px;
    }

    .m-cont>li p {
        margin-top: 3px;
        font-size: 14px;
    }

    .m-cont>li.add-list {
        background-color: #fff !important;
    }

</style>
<div id="contents" class="main-page"<?php echo $param->menu_toggle ? ' style="margin-top:160px;"' : '메뉴 열어두기'?>>
    <div class="wrap">
        <div class="page-title">
            <h3>메인페이지 구성</h3>
        </div>

        <div class="dan-add-btn">
            <button type="button" onclick="location.href = '<?php echo $param->get_page?>/step_add' ;">단 추가</button>
        </div>

        <form method="post" class="main-page-frm">
            <div class="dan-list">
                <input type="hidden" name="action" value="main_set">
                <?php foreach ($content_meta as $meta): ?>
                <div class="list">
                    <input type="hidden" name="p_od[]" value="<?php echo $meta->idx?>">
                    <p>
                        1단 : 상단 라인색 : <?php echo $meta->top_color ? $meta->top_color : "미설정";?> /
                        하단 라인색 : <?php echo $meta->btm_color ? $meta->btm_color : "미설정";?> /
                        배경색 : <?php echo $meta->bg_color ? $meta->bg_color  : "미설정";?>

                        <button type="button" class="main-page-set" onclick="window.open('<?php echo HOME_URL.'/popup/main_page_color/'.$meta->idx?>', 'main_page_color', 'width=600px,height=600px,left=100px,top=100px')">라인 및 배경색 설정</button>

                        <button type="button" class="cont-add" onclick="window.open('<?php echo HOME_URL.'/popup/main_page_cont_set/'.$meta->idx?>', 'main_page_cont_set', 'width=600px,height=600px,left=100px,top=100px')">+ 컨텐츠 추가</button>

                        <span>
                        <label><input type="checkbox" class="r_chk" name="p_remove[<?php echo $meta->idx?>]" >
                            삭제</label>
                    </span>
                    <ul class="m-cont">
                    <?php if (isset($step[$meta->idx])) foreach ($step[$meta->idx] as $data): ?>
                        <li>
                            <input type="hidden" name="c_od[<?php echo $meta->idx?>][]" value="<?php echo $data->idx?>">
                            <?php if ($data->bidx != 0): ?>
                            <p><span>↕</span> 컨텐츠 : 게시판 - <?php echo $data->name?> </p>
                            <?php else: ?>
                            <p><span>↕</span> 컨텐츠 : 배너 </p>
                            <?php endif ?>
                            <button type="button" class="cont-set" onclick="window.open('<?php echo HOME_URL.'/popup/main_page_cont_set_update/'.$data->idx?>', 'main_page_cont_set', 'width=600px,height=600px,left=100px,top=100px')">컨텐츠 설정</button>
                            <label><input type="checkbox" class="r_chk" name="c_remove[<?php echo $data->idx?>]"> 삭제</label>
                        </li>
                        <!-- <li>
                            <p><span>↕</span> 컨텐츠 : 게시판 - 커뮤니티 </p>
                            <button type="button" class="cont-set" >컨텐츠 설정</button>
                            <input type="checkbox" class="r_chk" name="remove-chk" > 삭제
                        </li>
                        <li>
                            <p><span>↕</span> 컨텐츠 : 게시판 - 갤러리 </p>
                            <button type="button" class="cont-set" >컨텐츠 설정</button>
                            <input type="checkbox" class="r_chk" name="remove-chk" > 삭제
                        </li> -->
                    <?php endforeach ?>
                    </ul>
                </div>
                <?php endforeach ?>
            </div>
            <div class="save-btn">
                <button type="submit">변경사항 적용하기</button>
            </div>
        </form>

    </div>
</div>
<script>
    $('.dan-list').sortable()
    $('.m-cont').sortable()
</script>