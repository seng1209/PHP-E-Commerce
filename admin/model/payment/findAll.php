<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Payment Date</th>
            <th scope="col">Payment Method</th>
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
        <td><?=$payment['amount']?></td>
        <td><?=$payment['status']?></td>
        <td>Action</td>
    </tr>
    <?php
        }
    ?>
    </tbody>
</table>