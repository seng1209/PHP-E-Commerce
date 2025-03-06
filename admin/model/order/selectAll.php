<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Order Date</th>
            <th scope="col">User</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    global $db;
    $orders = $db->read("users AS u INNER JOIN orders AS o ON o.user_id = u.user_id");
    foreach($orders as $order){
    ?>
        <tr>
            <th scope="row"><?=$order['order_id']?></th>
            <td><?=$order['order_date']?></td>
            <td><?=$order['username']?></td>
            <td><?=$order['total_amount']?></td>
            <td>
                <a href="index.php?p=order&id=<?=$order['order_id']?>" class="btn btn-warning m-1">Update</a>
                <a href="./model/order/delete.php?id=<?=$order['order_id']?>" class="btn btn-danger m-1">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>