<div class="review-write">
    <h4 class="modal-title">리뷰 작성</h4>
    <form action="<?php echo $param->get_page?>" method="post" onsubmit="submitContents(this); return false;" enctype="multipart/form-data">
        <input type="hidden" name="action" value="insert">
        <input type="hidden" name="writer" value="<?php echo $param->member->idx?>">
        <ul class="row s12">
            <li class="col s3 input-field">
                <select name="destination">
                    <option value="" disabled selected>관광지 선택</option>
                    <?php foreach ($destination as $data) { ?>
                        <option value="<?php echo $data->idx?>"><?php echo $data->subject?></option>
                    <?php } ?>
                </select>
            </li>
            <li class="col s9 input-field">
                <input id="review_subject" name="subject" type="text" class="validate" required>
                <label for="review_subject">제목</label>
            </li>
            <li class="col s12 input-field file-field">
                <div class="btn">
                    <span>대표이미지</span>
                    <input type="file" name="file" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </li>
            <li class="col s12">
                <textarea id="review-content" name="content" cols="80" rows="20" style="width:100%;height:300px;"></textarea>
            </li>
            <li class="col s12">
                <div class="center">
                    <button type="submit" class="btn-small light-blue darken-3 waves-effect waves-light">전송</button>
                    <button type="button" class="btn-small light-blue darken-1 waves-effect waves-light layer_close">닫기</button>
                </div>
            </li>
        </ul>
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
})
    
function submitContents(frm) {
    oEditors.getById["review-content"].exec("UPDATE_CONTENTS_FIELD", []);  // 에디터의 내용이 textarea에 적용됩니다.
    
    // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("review-content").value를 이용해서 처리하면 됩니다.

    alert(obj.content.value)
    try {
        obj.submit();
    } catch(e) {}
}

$('select').formSelect();
</script>