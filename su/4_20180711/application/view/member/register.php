<div class="register">
    <h4 class="modal-title">회원가입</h4>
    <div class="row">
        <form action="<?php echo "{$param->get_page}"?>" method="post">
            <input type="hidden" name=" action" value="insert">
            <ul class="col s12">
                <li class="row input-field">
                    <input id="register_id" name="id" type="text" class="validate" required pattern="(.{4,})" autofocus>
                    <label for="register_id">아이디</label>
                    <span class="helper-text" data-error="4글자 이상 입력해주세요" data-success="">아이디를 입력해주세요</span>
                </li>
                <li class="row input-field">
                    <input id="register_pw" name="pw" type="password" class="validate" required pattern="(.{4,})">
                    <label for="register_pw">비밀번호</label>
                    <span class="helper-text" data-error="4글자 이상 입력해주세요" data-success="">비밀번호를 입력해주세요</span>
                </li>
                <li class="row input-field">
                    <input id="register_pw_re" name="pw_re" type="password" class="validate" required pattern="(.{4,})">
                    <label for="register_pw_re">비밀번호 확인</label>
                    <span class="helper-text" data-error="4글자 이상 입력해주세요" data-success="">비밀번호를 다시 입력해주세요</span>
                </li>
                <li class="row input-field">
                    <input id="register_name" name="name" type="text" class="validate" required pattern="(.+)">
                    <label for="register_name">성명</label>
                    <span class="helper-text" data-error="이름을 입력해주세요" data-success="">이름을 입력해주세요</span>
                </li>
                <li class="row input-field">
                    <input id="register_email" name="email" type="email" class="validate" required>
                    <label for="register_email">이메일</label>
                    <span class="helper-text" data-error="이메일 형식으로 입력해주세요" data-success="">이메일을 입력해주세요</span>
                </li>
                <li>
                    <button type="submit" class="light-blue darken-1 waves-effect waves-light btn-small">회원가입</button>
                    <button type="button" class="light-blue darken-1 waves-effect waves-light btn-small layer_close">닫기</button>
                </li>
            </ul>
        </form>
    </div>
</div>