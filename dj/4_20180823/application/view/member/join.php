  <script type="text/javascript">
    $(function(){
      mapMarker();
    })
  </script>
            <div class="page-header">
              <!-- page title start-->
              <h1 class="page-title">
                회원가입
              </h1>
              <!-- page title end-->
            </div>

            <!-- contents start -->
            <div class="col-8 mx-auto mt-2">
              <div class="row">
            
                <form class="card" method="post">
                	<input type="hidden" name="action" value="join">
                  <div class="card-body p-6">
                    <div class="card-title">회원가입</div>
                    <div class="form-group">
                      <label class="form-label">아이디</label>
                      <input type="text" name="id" class="form-control" placeholder="영문 4~12이내">
                    </div>
                    <div class="form-group">
                      <label class="form-label">성명</label>
                      <input type="text" name="name" class="form-control" placeholder="한글 2~4이내">
                    </div>
                    <div class="form-group">
                      <label class="form-label">비밀번호</label>
                      <input type="password" name="pw" class="form-control" placeholder="영문숫자조합 4~8자이내">
                    </div>
                    <div class="form-group">
                      <label class="form-label">회원구분</label>
                      <div>
                        <select name="level" class="form-control custom-select">
                          <option value="">선택</option>
                          <option value="N">일반회원</option>
                          <option value="AF">가맹회원</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="form-label">전화번호</label>
                      <input type="text" name="tel" class="form-control" placeholder="0000-0000-0000형식">
                    </div> 
                    <div class="form-group">
                      <label class="form-label">위치정보</label>
                        <div>
                          <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">위치좌표(x, y)</h3>
                              <div class="col-3">
                                <input type="text" name="location" class="form-control position" readonly="readonly">
                              </div>
                              <span>지도에 위치를 클릭해주세요.</span>
                            </div>
                            <div class="card-map card-map-placeholder">
                                <div id="map">
                                  <img src="<?php echo IMG_URL ?>/map.jpg" id="map">
                                  <img src="<?php echo IMG_URL ?>/red_map_marker.png" id="marker">
                                </div>
                            </div>
                           
                          </div>
                        </div>
                    </div>

                    <div class="form-footer">
                      <div class="btn-list mt-4 text-center">
                        <button type="reset" class="btn btn-secondary btn-space">다시작성하기</button>
                        <button type="submit" class="btn btn-primary btn-space">회원가입</button>
                      </div>
                    </div>
                  </div>
                </form>
                
              </div>
            </div>
            <!-- contents end -->
