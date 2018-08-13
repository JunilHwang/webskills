<h2 class="content-title">여수시 관광지</h2>
<!-- tourlist destination card list -->
<?php foreach ($list as $data) { ?>
<article class="card tourlist">
    <a href="<?php echo HOME_URL?>/tour/view/<?php echo $data->idx?>" class="mask layerOpener"></a>
    <div class="img_wrap" style="background-image:url(<?php echo $data->uri?>)"></div>
    <div class="info">
        <h3 class="subject"><?php echo $data->subject?></h3>
        <div class="description"><?php echo shortContent($data->content, 55)?></div>
        <p class="tag">
            <span><?php echo str_replace(" ", "</span> <span>", $data->tag)?></span>
        </p>
    </div>
</article>
<?php } ?>