<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Payment Date</th>
            <th scope="col">Payment Method</th>
            <th scope="col">Order ID</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        global $db;
        $payments = $db->read("payments");
        foreach($payments as $payment){
    ?>
    <tr>
        <th scope="row"><?=$payment['payment_id']?></th>
        <td><?=$payment['payment_date']?></td>
        <td><?=$payment['payment_method_id']?></td>
        <td><?=$payment['order_id']?></td>
        <td><?=$payment['amount']?></td>
        <td><?=$payment['status']?></td>
        <td>
            <a href="index.php?p=payment&id=<?=$payment['payment_id']?>" class="btn btn-warning m-1">Update</a>
            <a href="./model/payment/delete.php?id=<?=$payment['payment_id']?>" class="btn btn-danger m-1">Delete</a>
        </td>
    </tr>
    <?php
        }
    ?>
    </tbody>
</table>