<div class="container-fluid">
    <?php
        $page = "insert.php";
        if(isset($_GET['id']))
            $page = "update.php";
        else
            $page = "insert.php";

        include "./model/payment/$page";
        include "./model/payment/findAll.php";
    ?>
</div>