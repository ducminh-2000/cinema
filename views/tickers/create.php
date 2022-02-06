<h2>Thêm mới vé</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="movie_id">Chọn phim</label>
        <select name="movie_id" class="form-control" id="movie_id">
            <?php foreach ($movies as $movie):
                $selected = '';
                if (isset($_POST['movie_id']) && $movie['id'] == $_POST['movie_id']) {
                    $selected = 'selected';
                }
                ?>
                <option value="<?php echo $movie['id'] ?>" <?php echo $selected; ?>>
                    <?php echo $movie['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="amount">Số lượng</label>
        <input type="number" name="amount" value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : '' ?>"
               class="form-control" id="amount"/>
    </div>
    <div class="form-group">
        <label for="price">Đơn giá</label>
        <input type="number" name="price" value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ?>"
               class="form-control" id="price"/>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary me-2"/>
        <a href="index.php?controller=ticker&action=index" class="btn btn-light">Back</a>
    </div>
</form>
