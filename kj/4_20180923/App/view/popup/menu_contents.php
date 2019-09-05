<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>메인 페이지 컨텐츠 설정</title>

    <link rel="stylesheet" href="../css/default.css">

    <link rel="stylesheet" href="../css/popup.css">

    <link rel="stylesheet" href="../admin/css/admin.css">

    <script src='../js/jquery.min.js'></script>

    <script src='../js/script.js'></script>
</head>

<body>
    <div id="menu-contents">
        <div class="page-title">
            메뉴별 컨텐츠
        </div>

        <div class="menu-type">
            <button type="button">초기화</button>
            <button type="button" onclick="location.href = '<?php echo "{$param->idx}?type=2"?>'; return false;">HTML 입력</button>
            <button type="button" onclick="location.href = '<?php echo "{$param->idx}?type=1"?>'; return false;">게시판 연동</button>
        </div>

        <div class="board-connect">
            <form method="post" class="table3-frm">
                <?php if ((isset($_GET['type']) && $_GET['type'] == 1) || !isset($_GET['type'])): ?>
                <input type="hidden" name="action" value="content-board">
                <table class="table2">
                    <thead>
                        <tr>
                            <th>현재설정 : 게시판을 연동합니다.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <select name="bidx" id="board">
                                    <option value="">선택하세요.</option>
                                    <?php foreach ($list as $board): ?>
                                    <option value="<?php echo $board->idx?>"<?php if ($board->idx === $data->bidx) echo " selected" ?>><?php echo $board->name?></option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php else: ?>
                <input type="hidden" name="action" value="content-html">
                <table class="table1">
                    <thead>
                        <tr>
                            <th>현재설정 : 내용을 작성합니다.</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <textarea name="content" rows="10" cols="80"><?php echo $data->content?></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php endif ?>
                <div class="save-btn" data-type="3">
                    <button type="submit">변경사항 적용하기</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
