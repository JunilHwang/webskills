<div class="course-write">
    <h4 class="modal-title">추천 코스 작성</h4>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="submitContents(this)">
        <input type="hidden" name="action" value="insert">
        <input type="hidden" name="writer" value="<?php echo $param->member->idx?>">
        <ul class="row">
            <li class="col s12 input-field">
                <input id="course_subject" name="subject" type="text" class="validate" required>
                <label for="course_subject">제목</label>
            </li>
            <li class="col s2">
                코스 선택
            </li>
            <li class="col s10">
                <p class="course-selected">선택된 관광지가 없습니다.</p>
                <input type="hidden" id="check-list" name="check_list" value="">
                <input type="hidden" name="check_list_string" value="">
            </li>
            <li class="col s12 input-field check-list">
                <?php foreach ($destination as $dest) { ?>
                <p>
                    <label>
                        <input type="checkbox" value="<?php echo $dest->idx?>">
                        <span><?php echo $dest->subject?></span>
                    </label>
                </p>
                <?php } ?>
            </li>
            <li class="col s12 input-field file-field">
                <div class="btn">
                    <span>대표이미지</span>
                    <input type="file" name="file" accept="image/*" multiple>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </li>
            <li class="col s12">
                <textarea id="review-content" name="content" cols="80" rows="20" style="width:100%;height:300px;"></textarea>
            </li>
        </ul>
        <div class="row center">
            <button type="submit" class="btn-small light-blue darken-3 waves-effect waves-light">전송</button>
            <button type="button" class="btn-small light-blue darken-1 waves-effect waves-light layer_close">취소</button>
        </div>
    </form>
</div>
<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({
    oAppRef: oEditors,
    elPlaceHolder: "review-content",
    sSkinURI: "<?php echo SRC_URL?>/se2/SmartEditor2Skin.html",  
    htParams : {
        bUseToolbar : true,             // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
        bUseVerticalResizer : true,     // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
        bUseModeChanger : true,         // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
    }, //boolean
    fCreator: "createSEditor2"
});
    
function submitContents(frm) {
    oEditors.getById["review-content"].exec("UPDATE_CONTENTS_FIELD", []);  // 에디터의 내용이 textarea에 적용됩니다.
    
    // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("review-content").value를 이용해서 처리하면 됩니다.
    
    try {
        frm.check_list_string.value = $('.course-selected').html().replace(/ \<i class\=\"material-icons\"\>navigate_next\<\/i\> /gi, ",");
        frm.submit();
    } catch(e) {}
}

</script>