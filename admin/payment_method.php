<div class="container-fluid">
    <?php
    require "./lib/PaymentMethodDB.php";
    $paymentMethodObj = new PaymentMethodDB();
    $page = "insert.php";
    if (isset($_GET["id"]))
        $page = "update.php";
    else
        $page = "insert.php";
    include "./model/payment_method/$page";
    ?>
    <?php include "./model/payment_method/findAll.php"?>

</div>