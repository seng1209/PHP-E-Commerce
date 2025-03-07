<div class="container-fluid">
    <?php
    $page = "insert.php";
    if (isset($_GET['id']))
        $page = "update.php";
    else
        $page = "insert.php";

    include "./model/order_product/$page";
    include "./model/order_product/selectAll.php";
    ?>
</div>