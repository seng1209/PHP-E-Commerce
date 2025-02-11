<div class="container-fluid">
    <?php 
        $page = "insert.php";
        if(isset($_GET['id']))
            $page = "update.php";
        else
            $page = "insert.php";
        
        include "./model/category/$page";
    ?>
    <?php include "./model/category/findAll.php" ?>
</div>