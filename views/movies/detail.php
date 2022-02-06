<h1>Chi tiết phim</h1>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $movie['id']; ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?php echo $movie['name']; ?></td>
    </tr>
    <tr>
        <th>Avatar</th>
        <td>
                    <?php if (!empty($movie['avatar'])): ?>
                        <img height="" src="assets/uploads/<?php echo $movie['avatar'] ?>" style="border-radius:0% !important;width:200px;height:140px"/>
                    <?php endif; ?>
                </td>
              
    </tr>
    <tr>
        <th>Mô tả</th>
        <td>
                <?php echo $movie['description']; ?>
              </td>
    </tr>
    <tr>
        <th>Created_at</th>
        <td>
            <?php echo date('d-m-Y H:i:s', strtotime($movie['created_at'])); ?>
        </td>
    </tr>
    <tr>
        <th>Updated_at</th>
        <td>
            <?php echo date('d-m-Y H:i:s', strtotime($movie['updated_at'])); ?>
        </td>
    </tr>
</table>
<a class="btn btn-primary" href="index.php?controller=movie">Back</a>

