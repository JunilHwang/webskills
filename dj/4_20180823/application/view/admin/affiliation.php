            <div class="page-header">
              <!-- page title start-->
              <h1 class="page-title">
                 가맹회원
              </h1>
              <!-- page title end-->
            </div>

            <!-- contents start -->
            <div class="col-12">
              <div class="row">
            
            <?php if($this->param->member->level == 'AF'): ?>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">가맹점등록</h3>
                    </div>
                    <div class="card-body1 p-5">
                      <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="franchisee">
                        <div class="form-group col-12">
                          <label class="form-label">가맹점분류</label>
                          <select class="custom-select col-2" name="type">
                            <option value="">가맹점분류선택</option> 
                            <option value="kf">한식</option> 
                            <option value="cf">중식</option>
                            <option value="jf">일식</option> 
                            <option value="ck">치킨</option>
                            <option value="pz">피자</option> 
                            <option value="nf">야식</option>
                          </select>
                        </div>
                        <div class="form-group col-12">
                          <label class="form-label">가맹점로고</label>
                          <input type="file" name="file" class="form-control">
                        </div>

                        <div class="form-group col-12">
                          <label class="form-label">가맹점명</label>
                          <input type="text" name="name" class="form-control">
                        </div>
                  <?php foreach ($franList as $data): ?>
                        <div class="col-12">
                          <img src="<?php echo DATA_URL."/{$data->logo}" ?>">
                          <strong><?php echo $data->name ?></strong>
                        </div>
                <?php endforeach;?>
                        <div class="form-footer col-12">
                          <button type="submit" class="btn btn-primary btn-block">가맹점등록</button>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="card mt-7">
                    <div class="card-header">
                      <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">메뉴등록</h3>
                    </div>
                    <div class="card-body1 p-5">
                      <form method="post">
                        <input type="hidden" name="action" value="menuInsert">
                        <div class="form-group col-12">
                          <label class="form-label">메뉴이름</label>
                          <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group col-12">
                          <label class="form-label">가격</label>
                          <input type="text" name="price" class="form-control">
                        </div>
                        <div class="form-footer col-12">
                          <button type="submit" class="btn btn-primary btn-block">메뉴등록</button>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="card mt-7">
                    <div class="card-header">
                      <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">메뉴목록</h3>
                    </div>
                    <div class="card-body1 p-5">
                      <div class="table-responsive">
                      <table class="table table-bordered table-vcenter text-nowrap card-table menuTable" style="border-top: 1px solid rgba(0, 40, 100, 0.12)">
                        <thead>
                          <tr>
                            <th>메뉴이름</th>
                            <th>가격</th>
                            <th>판매수량</th>
                            <th>등록일</th>
                            <th>메뉴삭제</th>
                          </tr>
                        </thead>
                        <tbody>
                    <?php foreach ($menuList as $data): ?>
                          <tr>
                            <td class="text-center">
                              <?php echo $data->name ?>
                            </td>
                            <td class="text-center">
                             <?php echo number_format($data->price) ?>원
                            </td>
                            <td class="text-center">
                              <?php echo $data->quantity ?>개
                            </td>
                            <td class="text-center">
                              <?php echo $data->date ?>
                            </td>
                            <td class="text-center">
                              <button type="button" onclick="location.replace('<?php echo HOME ?>/admin/menuDelete/?idx=<?php echo $data->idx ?>')" class="btn btn-secondary btn-space m-1">삭제</button>
                            </td>
                          </tr>
                    <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    </div>
                  </div>


                  <div class="card mt-7">
                    <div class="card-header">
                      <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">주문목록</h3>
                    </div>
                    <div class="card-body1 p-5">
                      <div class="table-responsive">
                      <table class="table table-bordered table-vcenter text-nowrap card-table" style="border-top: 1px solid rgba(0, 40, 100, 0.12)">
                        <thead>
                          <tr>
                            <th>주문일자</th>
                            <th>아이디</th>
                            <th>성명</th>
                            <th>전화번호</th>
                            <th>위치정보</th>
                            <th>메뉴이름</th>
                            <th>수량</th>
                            <th>가격</th>
                            <th>총 합계</th>
                            <th>주문상태</th>
                          </tr>
                        </thead>
                        <tbody class="text-center">
                    <?php foreach ($orderList as $data): ?>
                          <tr>
                            <td><?php echo $data->date ?></td>
                            <td><?php echo $data->id ?></td>
                            <td><?php echo $data->name ?></td>
                            <td><?php echo $data->tel ?></td>
                            <td>(<?php echo $data->x_location.", ".$data->y_location ?>)</td>
                            <td style="margin:0;padding:0;width:144px;">
                            <?php
                            $menuArr = explode("/",$data->menu);
                            for($i = 0; $i < count($menuArr); $i++):
                            ?>
                              <div style="border-bottom:1px solid #dee2e6;width:144px;"><?php echo $menuArr[$i]; ?></div>
                          <?php endfor; ?>
                            </td>
                            <td style="margin:0;padding:0;width:38px;">
                            <?php
                            $quantityArr = explode("/",$data->quantity);
                            for($i = 0; $i < count($quantityArr); $i++):
                            ?>
                              <div style="border-bottom:1px solid #dee2e6;width:38px;"><?php echo $quantityArr[$i]; ?>개</div>
                          <?php endfor; ?>
                            </td>
                            <td style="margin:0;padding:0;width:82px;">
                            <?php
                            $total_price = 0;
                            $priceArr = explode("/",$data->price);
                            for($i = 0; $i < count($priceArr); $i++):
                              $total_price += $priceArr[$i];
                            ?>
                              <div style="border-bottom:1px solid #dee2e6;width:82px;"><?php echo number_format($priceArr[$i]); ?>원</div>
                          <?php endfor; ?>
                            </td>
                            <td><?php echo number_format($total_price); ?>원</td>
                            <td>
                        <?php if($data->state == "shipping"): ?>
                              <button type="button" class="btn btn-secondary btn-space" onclick="location.replace('<?php echo HOME ?>/admin/delivery/?idx=<?php echo $data->idx ?>')">배송</button>
                        <?php else: ?>
                            배송완료
                        <?php endif; ?>
                            </td>
                          </tr>
                    <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    </div>
                  </div>



            <?php elseif($this->param->member->level == 'AD'): ?>
                  <!-- 관리자모드 -->
                  <div class="card mt-7">
                    <div class="card-header">
                      <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">가맹점 메뉴목록</h3>
                        <div class="col text-right">
                         <form method="get">
                          <select class="custom-select col-2" name="idx">
                            <option value="">가맹회원선택</option>
                             <?php foreach ($franList as $data):?>
                            <option value="<?php echo $data->idx ?>" <?php if(isset($_GET['idx']) && $_GET['idx'] == $data->idx) echo "selected"; ?>"><?php echo $data->name ?></option>
                             <?php endforeach; ?>
                          </select>
                          <button type="submit" class="btn btn-secondary btn-space">확인</button>
                        </form>
                      </div>
                    </div>
                    <div class="card-body1 p-5">
                      <div class="table-responsive">
                      <table class="table table-bordered table-vcenter text-nowrap card-table" style="border-top: 1px solid rgba(0, 40, 100, 0.12)">
                        <thead>
                          <tr>
                            <th>메뉴이름</th>
                            <th>가격</th>
                            <th>판매수량</th>
                          </tr>
                        </thead>
                        <tbody>
                  <?php foreach ($menuList as $data): ?>
                          <tr>
                            <td class="text-center">
                              <?php echo $data->name ?>
                            </td>
                            <td class="text-center">
                             <?php echo number_format($data->price) ?>원
                            </td>
                            <td class="text-center">
                              <?php echo number_format($data->quantity) ?>개
                            </td>
                          </tr>
                  <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    </div>
                  </div>

                  <div class="card mt-7">
                    <div class="card-header">
                      <h3 class="card-title" style="font-size: 1.2em; font-weight: bold;">메뉴랭킹</h3>
                    </div>
                    <div class="card-body1 p-5">
                      <div class="table-responsive">
                      <table class="table table-bordered table-vcenter text-nowrap card-table" style="border-top: 1px solid rgba(0, 40, 100, 0.12)">
                        <thead>
                          <tr>
                            <th>랭킹</th>
                            <th>가맹점명</th>
                            <th>메뉴이름</th>
                            <th>가격</th>
                            <th>판매수량</th>
                          </tr>
                        </thead>
                        <tbody>
                  <?php $i = 1;
                  foreach ($allMenuList as $data):?>
                          <tr>
                            <td class="text-center" style="width: 5%">
                              <?php echo $i ?>위
                            </td>
                            <td class="text-center">
                             <?php echo $data->franchisee ?>
                            </td>
                            <td class="text-center">
                              <?php echo $data->name ?>
                            </td>
                            <td class="text-center">
                              <?php echo number_format($data->price) ?>원
                            </td>
                            <td class="text-center">
                              <?php echo $data->quantity ?>개
                            </td>
                          </tr>
                  <?php $i++;
                endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    </div>
                  </div>
            <?php endif ?>


                
              </div>
            </div>
            <!-- contents end -->
