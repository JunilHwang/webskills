<div class="tour-detail">
    <ul>
        <li class="row">
            <h4 class="modal-title"><?php echo $data->subject?></h4>
        </li>
        <li class="row">
            <div class="img_wrap"><img src="<?php echo $data->uri?>" alt="<?php echo $data->origin?>"></div>
        </li>
        <li class="row">
            <?php foreach ($tags as $tag): ?>
            <div class="chip"><?php echo $tag?></div>
            <?php endforeach ?>
        </li>
        <li class="row">
            <?php echo $data->content?>
        </li>
        <li class="row">
            <div class="right">
                <a href="#!" class="light-blue darken-1 waves-effect waves-green btn-small layer_close">닫기</a>
            </div>
        </li>
    </ul>
</div>