<div class="container-fluid">
    <?php 
        require "./lib/BrandDB.php";
        $brandObj = new Brand();
        $page = "insert.php";
        if(isset($_GET['id']))
            $page = "update.php";            
        else
            $page = "insert.php";
        
        include "./model/brand/$page";
    ?>
    <?php 
        include "./model/brand/findAll.php"
    ?>
</div>