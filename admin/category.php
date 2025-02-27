<div class="container-fluid">
    <?php 
        require "./lib/CategoryDB.php";
        $categoryObj = new Category();
        $page = "insert.php";
        if(isset($_GET['id']))
            $page = "update.php";
        else
            $page = "insert.php";
        
        include "./model/category/$page";
    ?>
    <?php include "./model/category/findAll.php" ?>
</div>