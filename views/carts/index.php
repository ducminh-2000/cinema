
<!--Timeline items start -->
<div class="timeline-items container">
    <h2>Giỏ hàng của bạn</h2>
    <?php if (isset($_SESSION['cart'])): ?>
        <form action="" method="post">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th width="40%">Tên phim</th>
                    <th width="12%">Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <th></th>
                </tr>
                <?php
                    //Khai báo biến chứa tổng giá trị đơn hàng
                    $total_cart = 0;
                    foreach ($_SESSION['cart'] AS $ticker_id => $cart):
                ?>
                    <tr>
                        <td>
                            <!--  Do cấu trúc mvc hiên tại đang tách làm 2 thư
                             mục frontend và backend nên cần lên 1 cấp để có
                             thể vào backend lấy ảnh ra-->
                            <img class="ticker-avatar img-responsive"
                                 src="assets/uploads/<?php echo $cart['avatar']?>"
                                 width="80">
                            <div class="content-ticker">
                                <?php
                                //Khai báo link rewrite cho trang chi tiết sản phẩm
                                $ticker_link = "index.php?controller=ticker&action=detail&id=".$ticker_id;
                                ?>
                                <a href="<?php echo $ticker_link; ?>"
                                   class="content-ticker-a">
                                    <?php echo $cart['name']; ?>
                                </a>
                            </div>
                        </td>
                        <td>
                            <!-- cần khéo léo đặt name cho input số lượng,
                            để khi xử lý submit form update lại giỏ hàng sẽ đơn giản hơn
                               , với cấu trúc giỏ hàng hiện tại, thì sẽ đặt name chính là id
                               của sản phẩm, để khi update giỏ hàng xử lý rất đơn giản-->
                            <input type="number" min="0"
                                   name="<?php echo $ticker_id; ?>"
                                   class="ticker-amount form-control"
                                   value="<?php echo $cart['quantity']; ?>">
                        </td>
                        <td>
                            <?php echo number_format($cart['price']); ?>
                        </td>
                        <td>
                            <?php
                            $total_item = $cart['quantity'] * $cart['price'];
                            //Cộng tích lũy thành tiền này cho tổng giá trị
                            //đơn hàng
                            $total_cart += $total_item;
                            echo number_format($total_item);
                            ?>
                        </td>
                        <td>
                            <a class="content-ticker-a"
                               href="index.php?controller=cart&action=delete&id=<?php echo $ticker_id; ?>">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <!-- xóa <tr> thứ 3  -->


                <tr>
                    <td colspan="5" style="text-align: right">
                        Tổng giá trị đơn hàng:
                        <span class="ticker-price">
                           <?php echo number_format($total_cart); ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="ticker-payment">
                        <input type="submit" name="submit" value="Cập nhật lại giá" class="btn btn-primary">
                        <a href="index.php?controller=payment&action=index" class="btn btn-success">Hoàn tất</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    <?php else: ?>
        <h2>Giỏ hàng trống</h2>
        <a href="index.php?controller=home" class="btn btn-primary">
            Quay lại trang chủ
        </a>
    <?php endif; ?>
</div>
<!--Timeline items end -->