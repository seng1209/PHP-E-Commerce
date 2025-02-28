<table class="table">
    <thead>
    <tr style="text-align: center;">
        <th scope="col">ID</th>
        <th scope="col">Image</th>
        <th scope="col">Payment Method</th>
        <th scope="col">Price</th>
        <th scope="col">Description</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    global $db;
    $payment_methods = $db->read("payment_methods");
    foreach($payment_methods as $row){
        ?>
        <tr>
            <th scope="row"><?=$row['payment_method_id']?></th>
            <td><img src="uploads/images/payment_methods/<?=$row['image']?>" alt="<?=$row['image']?>" width="200px" /></td>
            <td><?=$row['name']?></td>
            <td><?=$row['price']?></td>
            <td><?=$row['description']?></td>
            <td style="text-align: center;">
                <a href="index.php?p=payment-method&id=<?=$row['payment_method_id']?>" class="btn btn-warning m-1">Update</a>
                <a href="model/payment_method/delete.php?id=<?=$row['payment_method_id']?>" class="btn btn-danger m-1">Delete</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
