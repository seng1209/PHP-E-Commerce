<table class="table">
    <thead>
        <tr style="text-align: center;">
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Brand</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            global $db;
            $brands = $db->read("brands");
            foreach($brands as $b){
        ?>
        <tr>
            <th scope="row"><?=$b['brand_id']?></th>
            <td><img src="uploads/images/brands/<?=$b['image']?>" alt="<?=$b['image']?>" width="200px" /></td>
            <td><?=$b['brand']?></td>
            <td><?=$b['description']?></td>
            <td style="text-align: center;">
                <a href="index.php?p=brand&id=<?=$b['brand_id']?>" class="btn btn-warning m-1">Update</a>
                <a href="model/brand/delete.php?id=<?=$b['brand_id']?>" class="btn btn-danger m-1">Delete</a>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
