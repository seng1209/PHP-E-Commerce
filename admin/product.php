<div class="container-fluid">
    <?php 
        require "./lib/ProductDB.php";
        require "./lib/CategoryDB.php";
        require "./lib/BrandDB.php";
        $productObj = new Product();
        $categoryObj = new Category();
        $brandObj = new Brand();
        $page = "insert.php";
        if(isset($_GET['id']))
            $page = "update.php";
        else
            $page = "insert.php";
        
        include "./model/product/$page"; 
    ?>
    <?php include "./model/product/findAll.php" ?>
</div>