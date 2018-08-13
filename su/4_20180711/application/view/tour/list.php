<h2 class="content-title">관광지 정보</h2>
<div class="row">
    <div class="search_frm">
        <form action="" method="post">
            <fieldset><!-- <legend>관광지 검색</legend> -->
                <input type="text" id="search_key" name="key" placeholder="검색어를 입력해주세요" size="50" value="<?php echo $param->search_key?>" class="browser-default" tabindex="1">
                <button type="submit" class="btn blue waves-effect waves-light">검색</button>
            </fieldset>
        </form>
    </div>
</div>
<?php if (isset($relatedList) && count($relatedList)) { ?>
<div class="row">
    <div class="col s12 relatedList">
        <h4 class="lbl">연관검색어</h4>
        <div class="desc">
            <?php foreach ($relatedList as $num=>$key_list): ?>
            <p>
                <strong>(<?php echo $num+1?>)</strong>
                <?php foreach ($key_list as $key): ?>
                <a href="<?php echo "{$param->get_page}/list/{$param->page_num}/".urlencode($key)?>"><?php echo $key?></a>
                <?php endforeach ?>
            </p>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php } ?>
<div class="row">
    <!-- <div class="col s12">
        <div class="right">
            <a href="<?php echo "{$param->get_page}/write"?>" class="btn light-blue darken-3 waves-effect waves-light layerOpener">추가</a>
        </div>
    </div> -->
    <div class="col s12">총 <?php echo $total?> 개의 관광지가 조회되었습니다</div>
</div>
<div class="row">
    <div class="col s12 tag_list">
        <h4>태그</h4>
        <?php
            foreach ($tag_list as $tag_data) {
                $encode_tag = urlencode($tag_data->name);
                $font_size = 13+$tag_data->cnt;
                if ($tag_data->name == $param->tag) {
                    $active = ' class="active"';
                    $link = "{$param->get_page}/list/1/".urlencode($param->search_key);
                    $none = " [취소]";
                } else {
                    $active = "";
                    $link = "?tag={$encode_tag}";
                    $none = "";
                }
                echo "<a href=\"{$link}\" style=\"font-size:{$font_size}px\"{$active}>#{$tag_data->name}{$none}</a>";
            }
        ?>
    </div>
</div>
<div class="row">
    <?php foreach ($list as $data) { ?>
    <article class="card tourlist">
        <a href="<?php echo "{$param->get_page}/view/{$data->idx}"?>" class="mask layerOpener"></a>
        <div class="img_wrap" style="background-image:url(<?php echo $data->uri?>)"></div>
        <div class="info">
            <h3 class="subject"><?php echo $data->subject?></h3>
            <div class="description"><?php echo shortContent($data->content, 55)?></div>
            <p class="tag">
                <span>#<?php echo str_replace(" ", "</span> <span>#", $data->tag)?></span>
            </p>
        </div>
    </article>
    <?php } ?>
</div>
<?php echo $paginate ?>
<script type="text/javascript" src="<?php echo SRC_URL?>/se2/js/HuskyEZCreator.js"></script>