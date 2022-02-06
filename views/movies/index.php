<h1>Tìm kiếm</h1>
<form action="" method="get">
    <input type="hidden" name="controller" value="movie"/>
    <input type="hidden" name="action" value="index"/>
    <div class="form-group">
        <label>Nhập tên phim</label>
        <input type="text" name="name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : '' ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-success"/>
        <a href="index.php?controller=movie" class="btn btn-secondary">Xóa filter</a>
    </div>
</form>

<h1>Danh sách phim</h1>
<a href="index.php?controller=movie&action=create" class="btn btn-primary">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Avatar</th>
        <th>Description</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th></th>
    </tr>
  <?php if (!empty($movies)): ?>
    <?php foreach ($movies as $movie): ?>
          <tr>
              <td>
                <?php echo $movie['id']; ?>
              </td>
              <td>
                <?php echo $movie['name']; ?>
              </td>
              <td>
                    <?php if (!empty($movie['avatar'])): ?>
                        <img height="" src="assets/uploads/<?php echo $movie['avatar'] ?>" style="border-radius:0% !important;width:80%;height:40px"/>
                    <?php endif; ?>
                </td>
              <td>
                <?php echo $movie['description']; ?>
              </td>
              <td>
                <?php echo date('d-m-Y H:i:s', strtotime($movie['created_at'])); ?>
              </td>
              <td>
                <?php
                if (!empty($movie['updatedAt'])) {
                  echo date('d-m-Y H:i:s', strtotime($movie['updated_at']));
                }
                ?>
              </td>
              <td>
                  <a href="index.php?controller=movie&action=detail&id=<?php echo $movie['id'] ?>"
                     title="Chi tiết">
                      <i class="fa fa-eye"></i>
                  </a>
                  <a href="index.php?controller=movie&action=update&id=<?php echo $movie['id'] ?>" title="Sửa">
                      <i class="fa fa-pencil-alt"></i>
                  </a>
                  <a href="index.php?controller=movie&action=delete&id=<?php echo $movie['id'] ?>" title="Xóa"
                     onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này')">
                      <i class="fa fa-trash"></i>
                  </a>
              </td>
          </tr>
    <?php endforeach ?>
      <tr>
          <td colspan="7"><?php echo $pages; ?></td>
      </tr>

  <?php else: ?>
      <tr>
          <td colspan="7">Không có bản ghi nào</td>
      </tr>
  <?php endif; ?>
</table>
<!--  hiển thị phân trang-->

