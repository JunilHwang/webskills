<?php
    $idx = isset($_GET['idx']) ? $_GET['idx'] : "";
?>
   <div id="header" class="main-header">
    <div class="wrap">
        <div id="logo">
            <h1><a href="/">전남관광명소</a></h1>
        </div>

        <div id="util-menu">
            <ul>
                <li><a>홈</a></li>
                <li><a href="#">E-mail : tour@yeosu.com</a></li>
                <li><a href="#">Contents</a></li>
                <li><button type="button" onclick="document.location.href = '/admin/login.php'">관리자모드</button></li>
            </ul>
        </div>
    </div>

    <div id="main-menu" class="main-hd">
        <div class="wrap">
            <ul class="menu">
                <?php
                    $list = $pdo->query("select * from menu_set where m_dan='1' and m_active='1' order by l_order asc");
                    while($list_r = $list->fetch(2)){
                    $f_mu = $pdo->query("select * from menu_set where m_dan='2' and m_active='1' and idx
                    ='{$idx}'")->fetch(2);
                ?>     
                <li><a href="/page/menu_content.php?idx=<?= $list_r['idx'] ?>" <?= $f_mu['parent_idx'] == $list_r['idx'] || $idx == $list_r['idx'] ? "style='color:#d1d11b;'" : "" ?> ><?= $list_r['name'] ?></a></li>
                <?php } ?>
            </ul>
        </div>

        <div class="submenu" style="display:none;">
            <div class="wrap">
                <div class="submenu-find">
                    <?php
                        $list = $pdo->query("select * from menu_set where m_dan='1' and m_active='1' order by l_order asc");
                        while($list_r = $list->fetch(2)){
                    ?>
                     <ul>
                        <?php
                            $list2 = $pdo->query("select * from menu_set where m_dan='2' and m_active='1' and parent_idx='{$list_r['idx']}' order by l_order asc");
                            while($list_r2 = $list2->fetch(2)){
                         ?>
                        <li><a href="/page/menu_content.php?idx=<?= $list_r2['idx'] ?>" ><?= $list_r2['name'] ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>