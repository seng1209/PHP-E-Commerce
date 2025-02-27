<div class="container-fluid">
    <?php 
        require "./lib/ShippingDB.php";
        $shippingObj = new Shipping();
        $page = "insert.php";
        if(isset($_GET['id']))
            $page = "update.php";
        else
            $page = "insert.php";
        
        include "./model/shipping/$page"; 
    ?>
    <?php include "./model/shipping/findAll.php" ?>
</div>