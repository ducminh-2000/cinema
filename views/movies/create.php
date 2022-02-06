<h2>Thêm mới phim</h2>
<form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label>Tên phim</label>
        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label>Ảnh</label>
        <input type="file" name="avatar" value="<?php echo isset($_POST['avatar']) ? $_POST['avatar'] : ''; ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label>Mô tả</label>
        <input type="text" name="description" value="<?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?>"
               class="form-control"/>
    </div>

    <input type="submit" class="btn btn-primary" name="submit" value="Save"/>
    <input type="reset" class="btn btn-secondary" name="submit" value="Reset"/>
</form>