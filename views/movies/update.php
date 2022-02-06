<?php if (empty($movie)): ?>
    <h2>Không tồn tại phim</h2>
<?php else: ?>
    <h2>Chỉnh sửa phim #<?php echo $movie['id'] ?></h2>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tên phim</label>
            <input type="text" name="name"
                   value="<?php echo isset($_POST['name']) ? $_POST['name'] : $movie['name']; ?>"
                   class="form-control"/>
        </div>
        <div class="form-group">
        <label>Ảnh</label>
        <input type="file" name="avatar" value="<?php echo isset($_POST['avatar']) ? $_POST['avatar'] : ''; ?>"
               class="form-control"/>
               <?php if (!empty($movie['avatar'])): ?>
                        <img height="" src="assets/uploads/<?php echo $movie['avatar'] ?>" style="border-radius:0% !important;width:200px;height:140px"/>
                    <?php endif; ?>
    </div>
    <div class="form-group">
        <label>Mô tả</label>
        <input type="text" name="description" value="<?php echo isset($_POST['description']) ? $_POST['description'] : $movie['description']; ?>"
               class="form-control"/>
    </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Save"/>
        <input type="reset" class="btn btn-secondary" name="submit" value="Reset"/>
    </form>
<?php endif; ?>