<div id="contents">
    <div class="wrap">
        <div class="page-title">
            <h2><?php echo $active_menu->title?></h2>
        </div>
    	<?php if ($active_menu->content != ''): ?>        		
        <?php echo $active_menu->content?>
    	<?php else: ?>
        <div class="no-page" style="display:none;">
            <div class="no-page-area">
                <div class="warning">
                    <img src="../images/warning.png" alt="warning">
                </div>

                <h2>현재 페이지는 연동이 되어있지 않습니다.</h2>
                <p>관리자에게 문의 바랍니다.</p>

                <button type="button">홈으로</button>
            </div>
        </div>
    	<?php endif ?>
    </div>
</div>