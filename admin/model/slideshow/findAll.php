<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Subtitle</th>
            <th scope="col">Link</th>
            <th scope="col">Enable</th>
            <th scope="col">Order Number</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        global $db;
        $slideshows = $db->read("slideshow");
        foreach($slideshows as $row){
    ?>
        <tr>
            <th scope="row"><?=$row['ss_id']?></th>
            <td><img src="./uploads/images/slider/<?=$row['image']?>" alt="<?=$row['image']?>" width="150px" /></td>
            <td><?=$row['title']?></td>
            <td><?=$row['sub_title']?></td>
            <td><?=$row['link']?></td>
            <td><?=$row['enable']?></td>
            <td><?=$row['order_number']?></td>
            <td>
                <a href="index.php?p=slideshow&id=<?=$row['ss_id']?>" class="btn btn-warning m-1">Update</a>
                <a href="./model/slideshow/delete.php?id=<?=$row['ss_id']?>" class="btn btn-danger m-1">Delete</a>
            </td>
        </tr>
    <?php
        }
    ?>
    </tbody>
</table>