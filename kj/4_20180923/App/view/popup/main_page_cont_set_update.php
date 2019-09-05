<div id="menu-contents">        
    <div class="page-title">
        메인페이지 컨텐츠
    </div>
    
    <div class="menu-type">
        <button type="button">초기화</button>
        <button type="button" onclick="location.replace('./<?php echo $param->idx?>?type=2')">배너 연동</button>
        <button type="button" onclick="location.replace('./<?php echo $param->idx?>?type=1')">게시판 연동</button>
    </div>
    
    <div class="board-connect">
        <form action="" method="post" enctype="multipart/form-data">
            <?php if (!isset($_GET['type']) || (isset($_GET['type']) && $_GET['type'] == 1)) { ?>
            <input type="hidden" name="action" value="board_set_update">
            <table class="table1">
                <thead>
                    <tr>
                        <th>현재설정 : 게시판을 연동합니다.</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <input type="hidden" name="type" value="1">
                            <select name="bidx">
                                <option value="">선택하세요.</option>
                                <?php foreach ($list as $data): ?>
                                <option value="<?php echo $data->idx?>"<?php if ($data->idx == $content->bidx) echo ' selected' ?>><?php echo $data->name?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php } else { ?>
            <input type="hidden" name="action" value="banner_set_update">
            <table class="table2">
                <thead>
                    <tr>
                        <th>현재설정 : 배너를 연동합니다.</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>기본 이미지 (필수사항)</td>
                                        <td>
                                            <input type="hidden" name="type" value="2">
                                            <ul>
                                                <li>
                                                    설정된 이미지가 없습니다.(GIF, JPG, PNG 파일만 업로드 가능합니다)
                                                <li><input type="file" name="def_img"></li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>오버 이미지 (선택사항)</td>
                                        <td>
                                            <ul>
                                                <li>
                                                       
                                                    설정된 이미지가 없습니다.(GIF, JPG, PNG 파일만 업로드 가능합니다)
                                                <li><input type="file" name="over_img"></li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>링크 URL</td>
                                        <td>
                                            <input type="text" name="link_url">
                                            <select name="link_type">
                                                <option value="1">현재창(_SELF)</option>
                                                <option value="2">새창(_blank)</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php } ?>
            <div class="save-btn" >
                <button type="submit">변경사항 적용하기</button>
            </div>
        </form>

    </div>
</div>