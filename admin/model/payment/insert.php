<?php

global $db;

$payment_method_id = $amount = "";

if (isset($_POST['submit'])) {
    $payment_method_id = $_POST['payment_method_id'];
    $amount = $_POST['amount'];

    echo "<script>alert('$payment_method_id $amount')</script>";
}

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Payment</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=payment" method="post">
                        <select class="form-select mb-3" name="shipment_method_id" aria-label="Default select example">
                            <option selected disabled>Payment Methods</option>
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
