<style type="text/css">
    .menu-set {
        float: left;
        width: 100%;
    }

    .menu-set .page-title {
        float: left;
        width: 100%;
        margin: 30px 0 50px;
    }

    .menu-set .menu-set-area {
        float: left;
        width: 100%;
    }

    .menu-set .menu-set-area .menu-set-list {
        float: left;
        width: 100%;
    }

    .menu-set .menu-set-area .menu-set-list>ul {
        float: left;
        width: 100%;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li {
        float: left;
        width: 100%;
        border-radius: 5px;
        background-color: #eee;
        padding: 15px 25px;
        border: 1px solid #cfcfcf;
        margin-bottom: 20px;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li>.box-area {
        float: left;
        width: 100%;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area {
        float: left;
        width: 100%;
        margin-left: 10px;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area .menu_parent_title {
        display: inline-block;
        width: 130px;
        height: 27px;
        color: #222;
        border: 1px solid #bba886;
        padding-left: 3px;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area .menu-num {
        display: inline-block;
        vertical-align: middle;
        font-size: 13px;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area #menu_switch {
        display: inline-block;
        width: 80px;
        height: 27px;
        background-color: #efefef;
        border: 1px solid #aaa;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area .two_menu_add {
        display: inline-block;
        padding: 0 8px;
        background-color: #f4f4f4;
        border: 1px solid #ccc;
        height: 27px;
        line-height: 27px;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area .parent-menu-remove {
        display: inline-block;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area .parent-menu-remove span {
        font-size: 13px;
        color: #444;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-parent-area>* {
        margin-right: 13px;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-child-box {
        float: left;
        width: 100%;
        margin-top: 10px;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-child-box>ul>li {
        float: left;
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        background-color: #fff;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-fot-control {
        float: right;
        margin-top: 10px;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-fot-control button {
        padding: 8px 15px;
        margin-left: 10px;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-fot-control .menu-add-btn {
        background-color: #333;
        color: #fff;
        border: 1px dotted #376c8b;
        border-radius: 3px;
    }

    .menu-set .menu-set-area .menu-set-list>ul>li .menu-fot-control .menu-remove-btn {
        background-color: #333;
        color: #fff;
        border: 1px dotted #376c8b;
        border-radius: 3px;
    }

    /*하위 메뉴*/

    .menu-child-box {
        float: left;
        width: 100%;
    }

    .menu-child-box>ul>li {
        float: left;
        width: 100%;
    }

    .menu-child-box>ul>.two-menu {
        float: left;
        width: 100%;
    }

    .menu-child-box>ul>.two-menu>* {
        display: inline-block;
        margin-right: 13px;
    }

    .menu-child-box>ul>.two-menu>input {
        width: 130px;
        height: 27px;
        color: #222;
        border: 1px solid #bba886;
        padding-left: 3px;
    }

    .menu-child-box>ul>.two-menu>#menu_switch {
        width: 80px;
        height: 27px;
        background-color: #efefef;
        border: 1px solid #aaa;
    }

    .menu-child-box>ul>.two-menu>.menu-num {
        font-size: 13px;
    }

    .menu-child-box>ul>.two-menu>.menu-title {
        float: left;
    }

    .menu-child-box>ul>.two-menu>.thrid_menu_add {
        padding: 0 8px;
        background-color: #f4f4f4;
        border: 1px solid #ccc;
        height: 27px;
        line-height: 27px;
    }

    .menu-child-box>ul>.two-menu>.parent-menu-remove span {
        font-size: 13px;
        color: #444;
    }

    /*3단 메뉴*/

    .thrid-menu {
        float: left;
        width: 100%;
    }

    .thrid-menu>li {
        float: left;
        width: 100%;
        background-color: #eee;
        padding: 10px;
        margin-top: 10px;
        border: 1px solid #cfcfcf;
        border-radius: 5px;
    }

    .thrid-menu>li>* {
        display: inline-block;
        margin-right: 13px;
    }

    .thrid-menu>li>h4 {
        font-size: 13px;
    }

    .thrid-menu>li>select {
        width: 80px;
        height: 27px;
        background-color: #efefef;
        border: 1px solid #aaa;
    }

    .thrid-menu>li>input {
        width: 130px;
        height: 27px;
        color: #222;
        background-color: #e1d6c2;
        border: 1px solid #bba886;
        padding-left: 3px;
    }

    .thrid-menu>li>.parent-menu-remove span {
        font-size: 13px;
        color: #444;
    }

    /*새로운 메뉴 추가 폼*/

    .menu-set .menu-set-area {
        float: left;
        width: 100%;
        border-radius: 3px;
    }

    .menu-set .menu-set-area form {
        float: left;
        margin-bottom: 10px;
    }

    .menu-set .menu-set-area .menu-add-frm {
        float: right;
        margin-bottom: 20px;
    }

    .menu-set .menu-set-area .menu-add-frm .frm-inp {
        float: left;
    }

    .menu-set .menu-set-area .menu-add-frm .frm-inp>label {
        float: left;
        line-height: 30px;
        font-size: 14px;
        margin-right: 10px;
    }

    .menu-set .menu-set-area .menu-add-frm .frm-inp>input {
        float: left;
        padding: 0 10px;
        height: 30px;
        border: 1px solid #25404f;
        background-color: #fafafa;
    }

    .menu-set .menu-set-area .menu-add-frm .menu-control-btn {
        float: left;
        margin-left: 10px;
    }

    .menu-set .menu-set-area .menu-add-frm .menu-control-btn>button {
        float: left;
        padding: 7px 13px;
        margin-right: 10px;
        border-radius: 2px;
        background-color: #333;
        color: #fff;
    }

</style>

<!-- AD_CONTENTS -->
<div id="contents"<?php echo $param->menu_toggle ? ' style="margin-top:160px;"' : '메뉴 열어두기'?>>
    <div class="menu-set">
        <div class="wrap">
            <div class="page-title">
                <h3>메뉴관리</h3>
            </div>

            <div class="menu-set-area">
                <div class="menu-add-frm">
                    <div class="menu-control-btn">
                        <button type="button" class="menu-add-btn" onclick="location.href = '<?php echo $param->get_page?>/menu_set_add'">추가</button>
                    </div>
                </div>

                <form method="post" id="menu-modify-frm">
                    <input type="hidden" name="action" value="menu_set">
                    <div class="menu-set-list">
                        <ul>
                            <!-- 1차 메뉴 -->
                            <?php foreach ($list as $key => $main): ?>
                            <li class="parent-menu-list">
                                <input type="hidden" name="main_od[]" value="<?php echo $main->idx?>">
                                <div class="box-area">
                                    <div class="menu-parent-area">
                                        <h4 class="menu-num">1차 메뉴</h4>
                                        <input type="text" name="m_title[<?php echo $main->idx?>]" value="<?php echo $main->title?>" class="menu_parent_title">

                                        <select name="m_hide[<?php echo $main->idx?>]" id="menu_switch">
                                            <option value="1"<?php echo $main->hide === '1' ? ' selected' : ''?>>사용</option>
                                            <option value="0"<?php echo $main->hide === '0' ? ' selected' : ''?>>사용 안함</option>
                                        </select>

                                        <button type="button" class="two_menu_add" onclick="location.href = '<?php echo $param->get_page.'/menu_set_add/'.$main->idx?>';">+ 2차 메뉴 추가</button>

                                        <div class="parent-menu-remove">
                                            <label>
                                                <input type="checkbox" name="m_remove[<?php echo $main->idx?>]">
                                                <span>이 메뉴와 하위 메뉴를 삭제</span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- 하위 메뉴 리스트 -->
                                    <div class="menu-child-box">
                                        <!-- 2차 메뉴 -->
                                        <ul class="two-menu-wrap">
                                        <?php foreach ($child[$main->idx] as $data): ?>
                                            <li class="two-menu">
                                                <input type="hidden" name="sub_od[<?php echo $main->idx?>][]" value="<?php echo $data->idx?>">
                                                <h4 class="menu-num">2차 메뉴</h4>
                                                <input type="text" name="s_title[<?php echo $main->idx?>][<?php echo $data->idx?>]" value="<?php echo $data->title?>" class="two_menu_title">

                                                <select name="s_hide[<?php echo $main->idx?>][<?php echo $data->idx?>]" id="menu_switch">
                                                    <option value="1"<?php if ($data->hide === '1') echo " selected" ?>>사용</option>
                                                    <option value="0"<?php if ($data->hide === '0') echo " selected" ?>>사용 안함</option>
                                                </select>

                                                <div class="parent-menu-remove">
                                                    <label>
                                                        <input type="checkbox" name="s_remove[<?php echo $main->idx?>][<?php echo $data->idx?>]" >
                                                        <span>이 메뉴와 하위 메뉴를 삭제</span>
                                                    </label>
                                                </div>
                                            </li>
                                        <?php endforeach ?>
                                        </ul>
                                    </div>

                                    <div class="menu-fot-control">
                                        <button type="button" class="menu-remove-btn" onclick="location.href = '<?php echo $param->get_page?>/menu_delete/<?php echo $main->idx?>'; return false;">전체 삭제</button>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach ?>
                        </ul>
                    </div>

                    <div class="menu-set-btn">
                        <button type="submit" class="menu-save-btn">변경사항 적용하기</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".menu-set-list ul").sortable()
</script>
