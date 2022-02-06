<?php
?>
<!--form search-->
<form action="" method="GET">
    <div class="form-group">
        <label for="title">Chọn phim</label>
        <select name="movie_id" class="form-control">
            <?php foreach ($movies as $movie):
                //giữ trạng thái selected của movie sau khi chọn dựa vào
//                tham số movie_id trên trình duyệt
                $selected = '';
                if (isset($_GET['movie_id']) && $movie['id'] == $_GET['movie_id']) {
                    $selected = 'selected';
                }
                ?>
                <option value="<?php echo $movie['id'] ?>" <?php echo $selected; ?>>
                    <?php echo $movie['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="hidden" name="controller" value="ticker"/>
    <input type="hidden" name="action" value="index"/>
    <input type="submit" name="search" value="Tìm kiếm" class="btn btn-primary"/>
    <a href="index.php?controller=ticker" class="btn btn-default">Xóa filter</a>
</form>


<h2>Danh sách vé</h2>
    <a href="index.php?controller=ticker&action=create" class="btn btn-success">
        <i class="fa fa-plus"></i> Thêm mới
    </a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Tên phim</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th></th>
    </tr>
    <?php if (!empty($tickers)): ?>
        <?php foreach ($tickers as $ticker): ?>
            <tr>
                <td><?php echo $ticker['id'] ?></td>
                <td><?php echo $ticker['movie_name'] ?></td>
                <td><?php echo number_format($ticker['amount']) ?></td>
                <td><?php echo $ticker['price'] ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($ticker['created_at'])) ?></td>
                <td><?php echo !empty($ticker['updated_at']) ? date('d-m-Y H:i:s', strtotime($ticker['updated_at'])) : '--' ?></td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=ticker&action=detail&id=" . $ticker['id'];
                    $url_update = "index.php?controller=ticker&action=update&id=" . $ticker['id'];
                    $url_delete = "index.php?controller=ticker&action=delete&id=" . $ticker['id'];
                    ?>
                    <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                    <a title="Update" href="<?php echo $url_update ?>"><i class="fa fa-pencil-alt"></i></a> &nbsp;&nbsp;
                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i
                                class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>

    <?php else: ?>
        <tr>
            <td colspan="9">No data found</td>
        </tr>
    <?php endif; ?>
</table>
<?php echo $pages; ?>