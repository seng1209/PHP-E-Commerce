<table class="table">
    <thead>
        <tr style="text-align: center;">
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Category</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $select = "SELECT * FROM categories";
            $result = $conn->query($select);
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
        ?>
        <tr>
            <th scope="row"><?=$row['category_id']?></th>
            <td><img src="uploads/images/categories/<?=$row['image']?>" alt="<?=$row['image']?>" width="200px" /></td>
            <td><?=$row['category']?></td>
            <td><?=$row['description']?></td>
            <td style="text-align: center;">
                <a href="index.php?p=category&id=<?=$row['category_id']?>" class="btn btn-warning m-1">Update</a>
                <a href="model/category/delete.php?id=<?=$row['category_id']?>" class="btn btn-danger m-1">Delete</a>
            </td>
        </tr>
        <?php
                }
            }
        ?>
    </tbody>
</table>