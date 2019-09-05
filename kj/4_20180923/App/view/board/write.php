<div id="contents">
    <div class="write-frm">
        <div class="wrap">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="insert">
                <div class="frm-ctrl">
                    <label for="title">게시글 제목</label>
                    <input type="text" name="title" id="title">
                </div>

                <div class="frm-ctrl">
                    <label for="writer">작성자</label>  
                    <input type="text" name="writer" id="writer">   
                </div>

                <div class="frm-ctrl">
                    <label for="file">첨부 파일</label>
                    <div class="u_file">
                        <?php for ($i=1; $i<=$board_set->upload_cnt; $i++) { ?>
                        <div class="f-list">
                            <input type="file" name="file<?php echo $i?>" id="file">
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="frm-ctrl">
                    <textarea name="text" placeholder="글 내용"></textarea>
                </div>

                <div class="write-btn">
                    <button type="submit">작성완료</button>
                    <button type="button" onclick="history.back(); return false;">취소</button>
                </div>
            </form>
        </div>
    </div>
</div>