<table class="table">
    <thead>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Product ID</th>
            <th scope="col">Quantity</th>
            <th scope="col">Amount</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    global $db;
    $orders_products = $db->read("order_products");
    foreach($orders_products as $order_product){
    ?>
    <tr>
        <th scope="row"><?=$order_product['order_id']?></th>
        <th scope="row"><?=$order_product['product_id']?></th>
        <td><?=$order_product['quantity']?></td>
        <td><?=$order_product['amount']?></td>
        <td>
            <a href="index.php?p=order_product&id=<?=$order_product['order_product_id']?>" class="btn btn-warning m-1">Update</a>
            <a href="./model/order_product/delete.php?id=<?=$order_product['order_product_id']?>" class="btn btn-danger m-1">Delete</a>
        </td>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>