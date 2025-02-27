<table class="table">
    <thead>
        <tr style="text-align: center;">
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Shipping Name</th>
            <th scope="col">Shipping Price</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $shippings = $shippingObj->readAll();
            foreach($shippings as $row){
        ?>
        <tr>
            <th scope="row"><?=$row['shipping_id']?></th>
            <td><img src="uploads/images/shipping/<?=$row['image']?>" alt="<?=$row['image']?>" width="200px" />
            </td>
            <td><?=$row['shipping_name']?></td>
            <td><?=$row['price']?></td>
            <td style="text-align: center;">
                <a href="index.php?p=shipping&id=<?=$row['shipping_id']?>" class="btn btn-warning m-1">Update</a>
                <a href="model/shipping/delete.php?id=<?=$row['shipping_id']?>" class="btn btn-danger m-1">Delete</a>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>