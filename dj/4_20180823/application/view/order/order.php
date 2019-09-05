  <script type="text/javascript">
    $(function(){
      posToggle();
      searchToggle();
      mapMarker();
    })
  </script>
            <div class="page-header">
              <!-- page title start-->
              <h1 class="page-title">
                 주문하기
              </h1>
              <!-- page title end-->
            </div>

            <!-- contents start -->
            <div class="col-12">
              <div class="row">
                
                <div class="form-group col-12">
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="value" onclick="location.replace('<?php echo HOME ?>/order/order/?type=all<?php if(isset($_GET['order'])) echo  "&order=".$_GET['order']; if(isset($_GET['idx'])) echo "&idx=".$_GET['idx']; ?>')" class="selectgroup-input" <?php if(!isset($_GET['type']) || $_GET['type'] == "all") echo "checked"; ?>>
                      <span class="selectgroup-button">전체보기</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="value" onclick="location.replace('<?php echo HOME ?>/order/order/?type=kf<?php if(isset($_GET['order'])) echo  "&order=".$_GET['order']; if(isset($_GET['idx'])) echo "&idx=".$_GET['idx']; ?>')" class="selectgroup-input" <?php if(isset($_GET['type']) && $_GET['type'] == "kf") echo "checked"; ?>>
                      <span class="selectgroup-button">한식</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="value" onclick="location.replace('<?php echo HOME ?>/order/order/?type=cf<?php if(isset($_GET['order'])) echo  "&order=".$_GET['order']; if(isset($_GET['idx'])) echo "&idx=".$_GET['idx']; ?>')" class="selectgroup-input" <?php if(isset($_GET['type']) && $_GET['type'] == "cf") echo "checked"; ?>>
                      <span class="selectgroup-button">중식</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="value" onclick="location.replace('<?php echo HOME ?>/order/order/?type=jf<?php if(isset($_GET['order'])) echo  "&order=".$_GET['order']; if(isset($_GET['idx'])) echo "&idx=".$_GET['idx']; ?>')" class="selectgroup-input" <?php if(isset($_GET['type']) && $_GET['type'] == "jf") echo "checked"; ?>>
                      <span class="selectgroup-button">일식</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="value" onclick="location.replace('<?php echo HOME ?>/order/order/?type=ck<?php if(isset($_GET['order'])) echo  "&order=".$_GET['order']; if(isset($_GET['idx'])) echo "&idx=".$_GET['idx']; ?>')" class="selectgroup-input" <?php if(isset($_GET['type']) && $_GET['type'] == "ck") echo "checked"; ?>>
                      <span class="selectgroup-button">치킨</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="value" onclick="location.replace('<?php echo HOME ?>/order/order/?type=pz<?php if(isset($_GET['order'])) echo  "&order=".$_GET['order']; if(isset($_GET['idx'])) echo "&idx=".$_GET['idx']; ?>')" class="selectgroup-input" <?php if(isset($_GET['type']) && $_GET['type'] == "pz") echo "checked"; ?>>
                      <span class="selectgroup-button">피자</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="value" onclick="location.replace('<?php echo HOME ?>/order/order/?type=nf<?php if(isset($_GET['order'])) echo  "&order=".$_GET['order']; if(isset($_GET['idx'])) echo "&idx=".$_GET['idx']; ?>')" class="selectgroup-input" <?php if(isset($_GET['type']) && $_GET['type'] == "nf") echo "checked"; ?>>
                      <span class="selectgroup-button">야식</span>
                    </label>
                  </div>
                </div>
                

                <div class="form-group col-4">
                  <div class="row gutters-xs">
                    <div class="col">
                      <input type="text" class="form-control" placeholder="가맹점검색">
                    </div>
                    <span class="col-auto">
                      <button class="btn btn-secondary" type="button"><i class="fe fe-search"></i></button>
                    </span>
                  </div>
                </div>

                <div class="form-group col-8 mt-2">
                  <div class="custom-controls-stacked">
                    <label class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="example-inline-radios" value="option1" onclick="location.replace('<?php echo HOME?>/order/order/?order=grade<?php if(isset($_GET['type'])) echo "&type=".$_GET['type']; if(isset($_GET['idx'])) echo "&idx=".$_GET['idx'] ?>')" <?php if(isset($_GET['order']) && $_GET['order'] == "grade") echo "checked" ?>>
                      <span class="custom-control-label">평점순</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="example-inline-radios" value="option2" onclick="location.replace('<?php echo HOME?>/order/order/?order=review<?php if(isset($_GET['type'])) echo "&type=".$_GET['type']; if(isset($_GET['idx'])) echo "&idx=".$_GET['idx'] ?>')" <?php if(isset($_GET['order']) && $_GET['order'] == "review") echo "checked" ?>>
                      <span class="custom-control-label">리뷰순</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="example-inline-radios" value="option3" onclick="location.replace('<?php echo HOME?>/order/order/?order=distance<?php if(isset($_GET['type'])) echo "&type=".$_GET['type']; if(isset($_GET['idx'])) echo "&idx=".$_GET['idx'] ?>')" <?php if(isset($_GET['order']) && $_GET['order'] == "distance") echo "checked" ?>>
                      <span class="custom-control-label">가까운지점</span>
                    </label>
                  </div>
                </div>
  
                <div class="col-12">
                  <div class="card">
                      <div class="card-map card-map-placeholder">
                          <div id="map"  style="float: left">
                            <img src="<?php echo IMG_URL ?>/map.jpg" id="map">
                            <img src="<?php echo IMG_URL ?>/red_map_marker.png" id="marker" style="left:<?php echo $param->member->x_location-10 ?>px;top:<?php echo $param->member->y_location-31 ?>px;">
                        <?php foreach ($franList as $data): ?>
                            <img src="<?php echo IMG_URL ?>/blue_map_marker.png" id="marker" style="left:<?php echo $data->x_location-10 ?>px;top:<?php echo $data->y_location-31 ?>px;">
                        <?php endforeach ?>
                            <img src="<?php echo IMG_URL ?>/pink_map_marker.png" id="marker" <?php if(isset($_GET['idx'])) echo "style='left:".($checkedFran->x_location-10)."px;top:".($checkedFran->y_location-31)."px;'" ?>>
                          </div>
                          <h3 class="text-center mt-6">전체보기</h3>
                          <table style="width: 433px; height: 220px;">
                            <tr>
                              <td style="vertical-align: middle;" class="text-left">
                                <p><img src="<?php echo IMG_URL ?>/red_map_marker.png" style="vertical-align: bottom; margin-left: 150px;"> &nbsp;&nbsp;회원위치</p>
                                <p><img src="<?php echo IMG_URL ?>/blue_map_marker.png" style="vertical-align: bottom; margin-left: 150px;"> &nbsp;&nbsp;가맹점위치</p>  
                                <p><img src="<?php echo IMG_URL ?>/pink_map_marker.png" style="vertical-align: bottom; margin-left: 150px;"> &nbsp;&nbsp;위치표시 가맹점</p>
                              </td>
                            </tr>
                          </table>
                      </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="card">
                    <table class="table card-table table-vcenter affiliationList">
                      <tbody>
                <?php foreach ($franList as $data): ?>
                        <tr title="<?php echo $data->name ?>">
                          <td style="width: 10%;"><img src="<?php echo DATA_URL ?>/<?php echo $data->logo ?>" alt="" class="h-8"></td>
                          <td>
                            <a href="<?php echo HOME ?>/order/menu/?idx=<?php echo $data->idx ?>" title="<?php echo $data->name ?> 메뉴주문 페이지">
                              <h5><?php echo $data->name ?></h5>
                              <ul class="list">
                                <li>
                                  <span class="title">평점</span>  
                                  <span class="badge badge-primary"><?php echo isset($data->avg_grade) ? $data->avg_grade : 0 ?>점</span>
                                </li>
                                <li>
                                  <span class="title">리뷰</span>  
                                  <span class="badge badge-primary"><?php echo isset($data->cnt) ? $data->cnt : 0 ?>개</span>
                                </li>
                              </ul>
                            </a>
                          </td>
                          <td>
                            가맹점위치<br>
                            회원위치정보(<?php echo $param->member->x_location.", ".$param->member->y_location ?>), 가맹점위치정보(<?php echo $data->x_location.", ".$data->y_location ?>)<br>
                            회원위치와 가맹점간의 거리 = <?php echo $data->distance ?>
                          </td>
                          <td class="text-right">
                            <label class="custom-switch">
                              <input type="radio" name="option" class="custom-switch-input" onclick="location.replace('<?php echo HOME?>/order/order/?idx=<?php echo $data->idx ?><?php if(isset($_GET['type'])) echo "&type=".$_GET['type'] ?>')" <?php if(isset($_GET['idx']) && $_GET['idx'] == $data->idx) echo "checked" ?>>
                              <span class="custom-switch-indicator"></span>
                              <span class="custom-switch-description">위치표시</span>
                            </label>
                          </td>
                        </tr>
                <?php endforeach; ?>

                	  </tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>
            <!-- contents end -->

