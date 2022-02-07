<?php
?>
<div class="controller">
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $ticker['id']?></td>
    </tr>
    <tr>
        <th>Tên danh mục</th>
        <td><?php echo $ticker['movie_name']?></td>
    </tr>
    <tr>
        <th>Tên sản phẩm</th>
        <td><?php echo $ticker['title']?></td>
    </tr>
    <tr>
        <th>Avatar</th>
        <td>
            <?php if (!empty($ticker['avatar'])): ?>
                <img height="80" src="assets/uploads/<?php echo $ticker['avatar'] ?>" style="border-radius: 0% !important;  width: 180px; height: 140px;"/>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>Số lượng</th>
        <td><?php echo number_format($ticker['amount']) ?></td>
    </tr>
    <tr>
        <th>Đơn giá</th>
        <td><?php echo number_format($ticker['price']) ?></td>
    </tr>
    <tr>
        <th>Mô tả ngắn</th>
        <td><?php echo $ticker['summary'] ?></td>
    </tr>
    <tr>
        <th>Mô tả chi tiết</th>
        <td><?php echo $ticker['content'] ?></td>
    </tr>
    <tr>
        <th>Created at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($ticker['created_at'])) ?></td>
    </tr>
    <tr>
        <th>Updated at</th>
        <td><?php echo !empty($ticker['updated_at']) ? date('d-m-Y H:i:s', strtotime($ticker['updated_at'])) : '--' ?></td>
    </tr>
</table>
<a href="index.php?controller=ticker&action=showAll" class="btn btn-default">Back</a>
</div>