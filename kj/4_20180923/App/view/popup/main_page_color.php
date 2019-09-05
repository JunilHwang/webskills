<div class="popup">
    <div class="page-title">
        메인페이지 구성
    </div>

    <form method="post">
        <input type="hidden" name="action" value="color_set">
        <table class="main-content">
            <colgroup>
                <col style="width:20%;">
                <col style="width:80%;">
            </colgroup>

            <tbody>
                <tr>
                    <td>영역 상단 라인색 (Border Color)</td>
                    <td>
                        <input type="text" name="top_color" value="" readonly>
                        <span class="prv-color" style="display:inline-block; vertical-align:middle; width:25px; height:25px; border:1px solid #ccc; "></span>
                        <img class="color-picker-entery" src="<?php echo IMG_URL?>/color.gif" alt="color">(R, G, B 색상코드 선택)
                        <div class="color-picker"></div>
                    </td>
                </tr>

                <tr>
                    <td>영역 하단 라인색 (Border Color)</td>
                    <td>
                        <input type="text" name="btm_color" value="" readonly>
                        <span class="prv-color" style="display:inline-block; vertical-align:middle; width:25px; height:25px; border:1px solid #ccc; "></span>
                        <img class="color-picker-entery" src="<?php echo IMG_URL?>/color.gif" alt="color">(R, G, B 색상코드 선택)
                        <div class="color-picker"></div>
                    </td>
                </tr>

                <tr>
                    <td>영역 배경색 (Background Color)</td>
                    <td>
                        <input type="text" name="bg_color" value=""  readonly>
                        <span class="prv-color" style="display:inline-block; vertical-align:middle;width:25px; height:25px; border:1px solid #ccc; "></span>
                        <img class="color-picker-entery" src="<?php echo IMG_URL?>/color.gif" alt="color">(R, G, B 색상코드 선택)
                        <div class="color-picker"></div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="save-btn">
            <button type="submit">변경사항 적용하기</button>
        </div>
    </form>
</div>
<script>
    $(document).on('click', '.color-picker-entery', function () {
        var el = this;
        if ($(el).next().html() != '') {
            $(el).next().html('')
            return false;
        }
        $.get("<?php echo HOME_URL?>/color-picker.php").done(function (data) {
            $(el).parents("td").find('.color-picker').html(data);
        })
    })
</script>