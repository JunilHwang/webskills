<div class="login">
    <h4 class="modal-title">로그인</h4>
    <div class="row">
        <form action="<?php echo $param->get_page?>" method="post">
            <input type="hidden" name="action" value="login">
            <ul class="col s12">
                <li class="row input-field">
                    <input id="login_id" name="id" type="text" class="validate" pattern="(.{4,})" autofocus>
                    <label for="login_id">아이디</label>
                    <span class="helper-text" data-error="아이디를 4글자 이상 입력해주세요" data-success="">아이디를 입력해주세요</span>
                </li>
                <li class="row input-field">
                    <input id="login_pw" name="pw" type="password" class="validate">
                    <label for="login_pw">비밀번호</label>
                    <span class="helper-text" data-error="비밀번호를 4글자 이상 입력해주세요" data-success="">비밀번호를 입력해주세요</span>
                </li>
                <li>
                    <button type="submit" class="light-blue darken-1 waves-effect waves-light btn-small">로그인</button>
                    <button type="button" class="light-blue darken-1 waves-effect waves-green btn-small layer_close">닫기</button>
                </li>
            </ul>
        </form>
    </div>
</div>