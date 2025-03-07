<?php

global $db;

$payment_id = $payment_date = $payment_method_id = $payment_method = $order_id = $amount = $status = "";

$id = $_GET['id'];

$row = $db->read("payments", "*", "payment_id = '$id'");

if ($row){
    $payment_method_id = $row['payment_method_id'];
    $order_id = $row['order_id'];
    $amount = $row['amount'];
}

$row1 = $db->read("payment_methods", "*", "payment_method_id = '$payment_method_id'");

if ($row1){
    $payment_method = $row1['name'];
}

if (isset($_POST['modify'])){
    if (Validator::notEmpty(isset($_POST['payment_method_id'])))
        $payment_method_id = $_POST['payment_method_id'];
    else
        $payment_method_id = $row['payment_method_id'];
    $order_id = $_POST['order_id'];
    $amount = $_POST['amount'];

    if (!Validator::notEmpty($payment_method_id))
        die("Payment Method is required");

    if (!Validator::notEmpty($amount))
        die("Amount is required");

    if (!Validator::notEmpty($order_id))
        die("Order is required");

    $data = [
            'payment_method_id' => $payment_method_id,
            'order_id' => $order_id,
            'amount' => $amount
    ];

    try {
        if (!$db->update("payments", $data, "payment_id='$id'"))
            die("Payment Method update failed");
    }catch (Exception $e){
        echo $e->getMessage();
    }
}

?>


<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Payment</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=payment&id=<?=$id?>" method="post">
                        <select class="form-select mb-3" name="payment_method_id" aria-label="Default select example">
                            <option selected disabled value="<?=$payment_method_id?>"><?=$payment_method?></option>
                            <?php
                            $payment_methods = $db->read("payment_methods");
                            foreach($payment_methods as $row){
                                ?>
                                <option value=" <?=$row['payment_method_id']?>"><?=$row['name']?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <select class="form-select mb-3" name="order_id" aria-label="Default select example">
                            <option selected disabled value="<?=$order_id?>"><?=$order_id?></option>
                            <?php
                            $orders = $db->read("orders");
                            foreach($orders as $row){
                                ?>
                                <option value=" <?=$row['order_id']?>"><?=$row['order_id']?> - <?=$row['total_amount']?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <div class="mb-3">
                            <label for="#" class="form-label">Amount</label>
                            <input type="text" name="amount" value="<?=$amount?>" class="form-control" />
                        </div>
                        <button type="submit" name="modify" class="btn btn-primary">
                            Modify
                        </button>
                        <a href="index.php?p=payment" class="btn btn-primary m-1">Create new Payment</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

