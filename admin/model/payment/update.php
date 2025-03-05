<?php

global $db;

$payment_id = $payment_date = $payment_method_id = $payment_method = $amount = $status = "";

$id = $_GET['id'];

$row = $db->read("payments", "*", "payment_id = '$id'");

if ($row){
    $payment_date = $row['payment_date'];
    $payment_method_id = $row['payment_method_id'];
    $payment_method = $row['payment_method'];
    $amount = $row['amount'];
}

$row1 = $db->read("payment_methods", "*", "payment_method_id = '$payment_method_id'");

if ($row1){
    $payment_method = $row1['payment_method'];
}

?>


<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Payment</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=payment&id=<?=$id?>" method="post">
                        <select class="form-select mb-3" name="shipment_method_id" aria-label="Default select example">
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
                        <div class="mb-3">
                            <label for="#" class="form-label">Amount</label>
                            <input type="text" name="amount" class="form-control" />
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

