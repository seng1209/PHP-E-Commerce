<table class="table">
    <thead>
        <tr style="text-align: center;">
            <th scope="col">ID</th>
            <th scope="col">Shipping Date</th>
            <th scope="col">Shipment Method</th>
            <th scope="col">User</th>
            <th scope="col">City</th>
            <th scope="col">Khan</th>
            <th scope="col">Sangkat</th>
            <th scope="col">Village</th>
            <th scope="col">Street Address</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            global $db;
            $shippings = $db->read("shipping");
            foreach($shippings as $row){
        ?>
        <tr>
            <th scope="row"><?=$row['shipping_id']?></th>
            <td><?=$row['shipping_date']?></td>
            <td><?=$row['shipment_method_id']?></td>
            <td><?=$row['user_id']?></td>
            <td><?=$row['city']?></td>
            <td><?=$row['khan']?></td>
            <td><?=$row['sangkat']?></td>
            <td><?=$row['village']?></td>
            <td><?=$row['street_address']?></td>
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