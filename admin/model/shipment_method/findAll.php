<table class="table">
    <thead>
    <tr style="text-align: center;">
        <th scope="col">ID</th>
        <th scope="col">Image</th>
        <th scope="col">Shipment Method</th>
        <th scope="col">Price</th>
        <th scope="col">Description</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    global $db;
    $shipment_methods = $db->read("shipment_methods");
    foreach($shipment_methods as $row){
        ?>
        <tr>
            <th scope="row"><?=$row['shipment_method_id']?></th>
            <td><img src="uploads/images/shipment_methods/<?=$row['image']?>" alt="<?=$row['image']?>" width="200px" /></td>
            <td><?=$row['name']?></td>
            <td><?=$row['price']?></td>
            <td><?=$row['description']?></td>
            <td style="text-align: center;">
                <a href="index.php?p=shipment-method&id=<?=$row['shipment_method_id']?>" class="btn btn-warning m-1">Update</a>
                <a href="model/shipment_method/delete.php?id=<?=$row['shipment_method_id']?>" class="btn btn-danger m-1">Delete</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
