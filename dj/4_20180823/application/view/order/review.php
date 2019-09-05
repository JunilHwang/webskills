            <div class="page-header">
              <!-- page title start-->
              <h1 class="page-title">
                피자스타 리뷰
              </h1>
              <!-- page title end-->
            </div>

            <!-- contents start -->
            <div class="col-12">
              <div class="row">
                  <div class="col-12">
                    <div class="mb-2 text-right">
                      <button type="submit" class="btn btn-primary" onclick="history.back()">메뉴목록</button>
                    </div>
                  </div>
              <?php foreach ($reviewList as $data):?>
                  <div class="card">
                    <div class="card-body1 p-5">
                      <article class="media">
                        <div class="media-body">
                          <div class="content">
                            <p class="h5">
                              <small><?php echo $data->name ?> (<?php echo str_pad(substr($data->id, 0, 3), strlen($data->id), "*") ?>)</small> 
                              <small>평점 : <?php echo $data->grade ?>점</small> 
                              <small class="float-right text-muted"><?php date("Y. m. d.",strtotime($data->date)) ?></small>
                            </p>
                            <p>
                              <?php echo $data->content ?>
                            </p>
                          </div>
                        </div>
                      </article>
                    </div>
                  </div>
              <?php endforeach; ?>
              </div>
            </div>
            <!-- contents end -->
