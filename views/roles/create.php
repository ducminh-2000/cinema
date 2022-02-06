<h2>Thêm mới quyền</h2>
<form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label>Tên </label>
        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>"
               class="form-control"/>
    </div>

    <input type="submit" class="btn btn-primary" name="submit" value="Save"/>
    <input type="reset" class="btn btn-secondary" name="submit" value="Reset"/>
</form>