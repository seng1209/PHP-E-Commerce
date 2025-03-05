<div class="container-fluid">
    <?php
    $page = "insert.php";
    if (isset($_GET['id']))
        $page = "update.php";
    else
        $page = "insert.php";

    include "./model/slideshow/$page";
    include "./model/slideshow/findAll.php";
    ?>
</div>