            <div class="page-header">
              <!-- page title start-->
              <h1 class="page-title">
                 주문내역
              </h1>
              <!-- page title end-->
            </div>

            <!-- contents start -->
            <div class="col-12">
              <div class="row">
                <div class="col-6 mb-2 text-left">
                  <h3 style="color: red;">총 결제금액 : <?php echo $total_price ?>원</h3> 
                </div>
          <?php if($param->member->level == "AD"): ?>
                <!-- 관리자모드 -->
                <div class="col-6 mb-2 text-right">
                  <select class="custom-select col-4">
                    <option value="">회원검색</option>
              <?php foreach ($memberList as $member): ?>
                    <option value="<?php echo $member->idx ?>"><?php echo $member->name ?>[<?php echo $member->id ?>]</option>
              <?php endforeach; ?>
                  </select>
                  <button type="button" class="btn btn-secondary btn-space">확인</button>
                </div>
          <?php endif; ?>
                <div class="col-12">
                  <div class="card">
                    <div class="table-responsive">
                      <table class="table table-bordered table-vcenter text-nowrap card-table">
                        <thead>
                          <tr>
                            <th>결제일자</th>
                            <th>가맹점정보</th>
                            <th>메뉴이름</th>
                            <th>가격</th>
                            <th>수량</th>
                            <th>주문상태</th>
                            <th>총 합계</th>
                          </tr>
                        </thead>
                      <tbody>
                    <?php foreach ($orderList as $data):?>
                          <tr>
                            <td class="text-center">
                              <?php echo $data->date ?>
                            </td>
                            <td class="text-center">
                              <div>
                                <img src="<?php echo DATA_URL ?>/<?php echo $data->logo ?>" alt="<?php echo $data->name ?>">
                                <p class="m-0">
                                  <small><?php echo $data->name ?></small>
                                </p>
                              </div>
                            </td>
                            <td class="text-center">
                      <?php $menuArr = explode("/",$data->menu);
                            for($j = 0; $j < count($menuArr); $j++):
                            ?>
                              <div style="border-bottom:1px solid #dee2e6;width:144px;"><?php echo $menuArr[$j]; ?></div>
                        <?php endfor;?>
                            </td>
                            <td class="text-center">
                      <?php $quantityArr = explode("/",$data->quantity);
                            for($j = 0; $j < count($quantityArr); $j++):
                            ?>
                              <div style="border-bottom:1px solid #dee2e6;width:38px;"><?php echo $quantityArr[$j]; ?>개</div>
                      <?php endfor; ?>
                            </td>
                            <td class="text-center">
                      <?php $price = 0;
                            $priceArr = explode("/",$data->price);
                            for($j = 0; $j < count($priceArr); $j++):
                              $price += $priceArr[$j];
                            ?>
                              <div style="border-bottom:1px solid #dee2e6;width:82px;"><?php echo number_format($priceArr[$j]); ?>원</div>
                      <?php endfor; ?>
                            </td>
                            <td class="text-center">
                        <?php if($data->state == "shipping"): ?>
                              배송중
                        <?php else: ?>
                              배송완료
                              <p class="m-0">
                                <a href="<?php echo HOME ?>/order/write/?idx=<?php echo $data->fidx ?>" class="btn btn-sm btn-outline-primary">리뷰작성</a>
                              </p>
                        <?php endif; ?>
                            </td>
                            <td class="text-center">
                              <?php echo number_format($price) ?>원
                            </td>
                          </tr>
                    <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
            <!-- contents end -->
