<div id="contents"<?php echo $param->menu_toggle ? ' style="margin-top:160px;"' : '메뉴 열어두기'?>>
    <div class="login-frm">
        <div class="wrap">
            <div class="frm-title">
                <h3>로그인</h3>
            </div>

            <form action="" method="post">
                <input type="hidden" name="action" value="login">
                <input type="text" name="userid" id="userid" placeholder="아이디">
                <input type="password" name="pw" id="pw" placeholder="비밀번호">
                <button type="submit">로그인</button>
            </form>
        </div>
    </div>
</div>