<div id="contents" class="menu_contents"<?php echo $param->menu_toggle ? ' style="margin-top:160px;"' : '메뉴 열어두기'?>>
    <div class="wrap">
        <div class="page-title">
            <h3>메뉴별 컨텐츠</h3>
        </div>

        <table>
            <thead>
                <th>1차 메뉴</th>
                <th>2차 메뉴</th>
                <th>컨텐츠 구성</th>
            </thead>

            <tbody>
                <?php foreach ($list as $main): ?>
                <tr>
                    <td style="background-color:#3a3a3a; color:#fff;"><?php echo $main->title?></td>
                    <td></td>
                    <td>
                        <?php echo $main->type?>
                        <?php if ($main->bidx != 0) echo " - {$main->board_title}" ?>
                        <button type="button" class="cont-change" onclick="window.open('<?php echo HOME_URL?>/popup/menu_contents/<?php echo $main->idx?>', 'menu_contents', 'width=600px,height=600px,left=100px,top=100px')">변경</button>
                    </td>
                </tr>
                <?php foreach ($child[$main->idx] as $sub): ?>
                <tr>
                    <td></td>
                    <td style="background-color:#3a3a3a; color:#fff;"><?php echo $sub->title?></td>
                    <td>
                        <?php echo $sub->type?>
                        <?php if ($sub->bidx != 0) echo " - {$sub->board_title}" ?>
                        <button type="button" class="cont-change" onclick="window.open('<?php echo HOME_URL?>/popup/menu_contents/<?php echo $sub->idx?>', 'menu_contents', 'width=600px,height=600px,left=100px,top=100px')">변경</button>
                    </td>
                </tr>
                <?php endforeach ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>