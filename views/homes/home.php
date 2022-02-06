
<!--    movie-->
<div class="movie-wrap">
    <div class="movie container">
      <?php if (!empty($movies)): ?>
          <h1 class="post-list-title">
              <a href="index.php?controller=movie&action=showAll" class="link-category-item">Danh sách phim</a>
          </h1>
          <div class="link-secondary-wrap row">
            <?php foreach ($movies AS $movie):
              $movie_link = "index.php?controller=movie&action=detail&id=" . $movie['id'];
              $movie_cart_add = "index.php?controller=ticker&id=" . $movie['ticker_id'];
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
                            <?php echo "Giá vé: " .number_format($movie['ticker_price']) ?>
                </span>

                    <span class="add-to-cart"
                          data-id="<?php echo $movie['ticker_id']; ?>">
                        <a href="index.php?controller=home" style="color: inherit">Mua vé</a>
                    </span>
                </div>
            <?php endforeach; ?>
          </div>
      <?php endif; ?>
    </div>
</div>
<!--    END movie-->
