<div id="contents" class="main-image"<?php echo $param->menu_toggle ? ' style="margin-top:160px;"' : '메뉴 열어두기'?>>
    <div class="wrap">
        <div class="page-title">
            <h3>애니메이션 구성</h3>
        </div>

        <form class="main-image-frm" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="main_image_set">
            <table>
                <colgroup>
                    <col style="width:17%;">
                    <col style="width:22%;">
                    <col style="width:22%;">
                    <col style="width:22%;">
                    <col style="width:17%;">
                </colgroup>

                <thead>
                    <tr>
                        <th>좌측배경 (옵션)</th>
                        <th>이미지1</th>
                        <th>이미지2</th>
                        <th>이미지3</th>
                        <th>우측배경 (옵션)</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <span>배경색 : #<input type="text" name="left_back" maxlength="6" value="<?php echo $data->left_back?>"><div class="btn" ><button type="button" class="bc-remove c-remove" onclick="location.href = '<?php echo "{$param->get_page}/main_image_design_delete/left_back"?>'" >삭제</button></div>
                           </span>
                        </td>
                        <td>
                            <span >
                                <button type="button" class="f_find" style="float:left;">파일 선택</button> <span class="f_name" style="width:auto;">
                                    <?php echo isset($data->m_img[0]->origin_name) && $data->m_img[0]->origin_name != '' ? $data->m_img[0]->origin_name : "선택파일없음"; ?>
                                </span><input type="file" class="file" name="m_img1" style="float:left; width:180px; display:none;" onchange="v2">
                                <div class="btn"><button type="button" class="bc-remove i-remove" onclick="location.href = '<?php echo "{$param->get_page}/main_image_design_delete/m_img1"?>'" >삭제</button></div>
                            </span>
                        </td>
                        <td>
                            <span >
                                <button type="button" class="f_find" style="float:left;">파일 선택</button> <span class="f_name" style="width:auto;">
                                    <?php echo isset($data->m_img[1]->origin_name) && $data->m_img[1]->origin_name != '' ? $data->m_img[1]->origin_name : "선택파일없음"; ?>
                                </span><input type="file" class="file" name="m_img2" style="float:left; width:180px; display:none;" onchange="v2">
                            <div class="btn"><button type="button" class="bc-remove i-remove" onclick="location.href = '<?php echo "{$param->get_page}/main_image_design_delete/m_img2"?>'" >삭제</button></div>
                            </span>
                        </td>
                        <td>
                            <span >
                                <button type="button" class="f_find" style="float:left;">파일 선택</button> <span class="f_name" style="width:auto;">
                                    <?php echo isset($data->m_img[2]->origin_name) && $data->m_img[2]->origin_name != '' ? $data->m_img[2]->origin_name : "선택파일없음"; ?>
                                </span><input type="file" class="file" name="m_img3" style="float:left; width:180px; display:none;" onchange="v2">
                            <div class="btn"><button type="button" class="bc-remove i-remove" onclick="location.href = '<?php echo "{$param->get_page}/main_image_design_delete/m_img3"?>'" >삭제</button></div>
                            </span>
                        </td>

                        <td>
                            <span>
                               배경색 : #<input type="text" name="right_back" maxlength="6" value="<?php echo $data->right_back?>"><div class="btn" ><button type="button" class="bc-remove c-remove" onclick="location.href = '<?php echo "{$param->get_page}/main_image_design_delete/right_back"?>'" >삭제</button></div>
                           </span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="rotaction-sec">
                <input type="text" name="second" value="<?php echo $data->second?>">
                <p>초(Sec.) 마다 대표이미지를 변경합니다.</p>
            </div>

            <div class="save-btn">
                <button type="submit" >변경사항 적용하기</button>
            </div>
        </form>


    </div>
</div>
<script>
    $(document).on('click', '.f_find', function () {
        $(this).parents("span").find('input').click();
    });

    $(document).on('change', '.file', function (e) {
        var files = e.target.files[0];
        $(this).parents('span').find('.f_name').text(files.name);
    });
</script>