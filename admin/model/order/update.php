<?php

global $db;

$user_id = $username = $total_amount = "";

$id = $_GET['id'];

$row = $db->read("orders", "*", "order_id = '$id'");

if ($row){
    $user_id = $row["user_id"];
    $total_amount = $row["total_amount"];
}

$row1 = $db->read("users", "*", "user_id = '$user_id'");
if ($row1){
    $username = $row1['username'];
}

if (isset($_POST['modify'])) {
    if (Validator::notEmpty(isset($_POST['user_id'])))
        $user_id = $_POST['user_id'];
    else
        $user_id = $row['user_id'];
    $total_amount = $_POST['total_amount'];

    if (!Validator::notEmpty($total_amount))
        die("Total amount is required");

    if (!Validator::notEmpty($user_id))
        die("User ID is required");

    $data = [
        "user_id" => $user_id,
        "total_amount" => $total_amount
    ];

    try {
        if (!$db->update("orders", $data, "order_id='$id'"))
            die("Failed to create order");
    }catch (Exception $e){
        echo $e->getMessage();
    }

}

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Forms</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=order&id=<?=$id?>" method="post">
                        <select class="form-select" name="user_id" aria-label="">
                            <option selected disabled value="<?=$user_id?>"><?=$username?></option>
                            <?php
                            $users = $db->readBy("users", "*", "role = 'customer'");
                            foreach ($users as $user){
                                ?>
                                <option value="<?=$user['user_id']?>"><?=$user['username']?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <div class="mb-3">
                            <label for="" class="form-label">Total Amount</label>
                            <input
                                type="number"
                                name="total_amount"
                                value="<?=$total_amount?>"
                                class="form-control"
                                id=""
                                aria-describedby="emailHelp"
                            />
                        </div>
                        <button type="submit" name="modify" class="btn btn-primary">
                            Modify
                        </button>
                        <a href="index.php?p=order" class="btn btn-primary m-1">Create new Order</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
