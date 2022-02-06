<!--Chức nwang filter do kết hợp với rewrite url nên ko dùng phương thức GET cho form, vì xử lý rewrite sẽ rất phức tạp
thay vào đó sẽ dùng POST
-->
<?php
?>
<div class="container">
    <div class="row">
        <div class="main-left col-md-3 col-sm-3 col-xs-12">
            <!-- <h3>Lọc</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <b>Khoảng giá</b> <br/>
                  <?php
                  //cần đổ lại dữ liệu ra form search
                  $price1_checked = '';
                  $price2_checked = '';
                  $price3_checked = '';
                  $price4_checked = '';
                  if (isset($_POST['price'])) {
                    foreach ($_POST['price'] as $price) {
                      if ($price == 1) {
                        $price1_checked = 'checked';
                      }
                      if ($price == 2) {
                        $price2_checked = 'checked';
                      }
                      if ($price == 3) {
                        $price3_checked = 'checked';
                      }
                      if ($price == 4) {
                        $price4_checked = 'checked';
                      }
                    }
                  }
                  ?>
                    <input type="checkbox" name="price[]" value="1" <?php echo $price1_checked; ?> /> Dưới 1tr <br/>
                    <input type="checkbox" name="price[]" value="2" <?php echo $price2_checked; ?> /> Từ 1 - 2tr
                    <br/>
                    <input type="checkbox" name="price[]" value="3" <?php echo $price3_checked; ?> /> Từ 2 - 3tr
                    <br/>
                    <input type="checkbox" name="price[]" value="4" <?php echo $price4_checked; ?> /> Trên 3tr
                    <br/>
                </div>
                <div class="form-group">
                    <input type="submit" name="filter" value="Filter" class="btn btn-primary"/>
                    <a href="index.php?controller=movie&action=showAll" class="btn btn-default">Xóa filter</a>
                </div>
            </form> -->
        </div>
        <div class="main-right col-md-9 col-sm-9 col-xs-12">
            <h2>Danh sách phim</h2>
          <?php if (!empty($movies)): ?>
              <div class="link-secondary-wrap row">
                <?php foreach ($movies AS $movie):
                   $movie_link = "index.php?controller=movie&action=detail&id=" . $movie['id'];
                   $movie_cart_add = "index.php?controller=movie&id=" . $movie['id'];
                  ?>
                    <div class="service-link col-md-3 col-sm-6 col-xs-12">
                        <a href="<?php echo $movie_link; ?>">
                            <img class="secondary-img img-responsive" title="<?php echo $movie['name'] ?>"
                                 src="assets/uploads/<?php echo $movie['avatar'] ?>"
                                 alt="<?php echo $movie['name'] ?>"/>
                            <span class="shop-title">
                        <?php echo $movie['name'] ?>
                    </span>
                        </a>
                        <span class="shop-price">
                            <?php echo number_format($movie['ticker_price']) ?>
                </span>

                        <span data-id="<?php echo $movie['ticker_id'] ?>" class="add-to-cart">
                        <a href="<?php echo $movie_cart_add ?>" style="color: inherit">Thêm vào giỏ</a>
                    </span>
                    </div>
                <?php endforeach; ?>

              <?php echo $pagination; ?>
              </div>
          <?php endif; ?>
        </div>
    </div>

</div>
<!-- <?php //echo $pages?> -->

