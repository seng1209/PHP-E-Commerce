
<table class="table">
    <thead>
        <tr style="text-align: center;">
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col">Brand</th>
            <th scope="col">Description</th>
            <th scope="col">In Stock</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            global $productObj;
            $products = $productObj->readAll();
            foreach($products as $row){
        ?>
        <tr>
            <th scope="row"><?=$row['product_id']?></th>
            <td><img src="uploads/images/products/<?=$row['image']?>" alt="<?=$row['image']?>" width="200px" />
            </td>
            <td><?=$row['product_name']?></td>
            <td><?=$row['price']?></td>
            <td><?=$row['category_id']?></td>
            <td><?=$row['brand_id']?></td>
            <td><?=$row['description']?></td>
            <td><?=$row['in_stock']?></td>
            <td style="text-align: center;">
                <a href="index.php?p=product&id=<?=$row['product_id']?>" class="btn btn-warning m-1">Update</a>
                <a href="model/product/delete.php?id=<?=$row['product_id']?>" class="btn btn-danger m-1">Delete</a>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>