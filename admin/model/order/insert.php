<?php

global $db;

$user_id = $username = $total_amount = "";

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
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
        if (!$db->create("orders",$data))
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
                    <form action="index.php?p=order" method="post">
                        <select class="form-select" name="user_id" aria-label="">
                            <option selected disabled >User Name</option>
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
                                class="form-control"
                                id=""
                                aria-describedby="emailHelp"
                            />
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
