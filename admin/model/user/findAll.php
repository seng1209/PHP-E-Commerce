<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        global $db;

        $users = $db->read("users");
        foreach ($users as $user) {
    ?>
    <tr>
        <th scope="row"><?=$user['user_id']?></th>
        <td><img src="uploads/images/users/<?=$user['image']?>" alt="<?=$user['image']?>" width="200px" /></td>
        <td><?=$user['username']?></td>
        <td><?=$user['email']?></td>
        <td><?=$user['phone']?></td>
        <td><?=$user['address']?></td>
        <td><?=$user['role']?></td>
        <td>
            <a href="index.php?p=user&id=<?=$user['user_id']?>" class="btn btn-warning m-1">Update</a>
            <a href="./model/user/delete.php?id=<?=$user['user_id']?>" class="btn btn-danger m-1">Delete</a>
        </td>
    </tr>
    <?php
        }
    ?>
    </tbody>
</table>