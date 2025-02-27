<div class="container-fluid">
    <?php
    require "./lib/ShipmentMethodDB.php";
    $shipmentMethodObj = new ShipmentMethodDB();
    $page = "insert.php";
    if (isset($_GET['id']))
        $page = "update.php";
    else
        $page = "insert.php";

    include "./model/shipment_method/$page";
    ?>
    <?php
        include "./model/shipment_method/findAll.php";
    ?>
</div>

