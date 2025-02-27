<div class="container-fluid">
    <?php

        require "./lib/UserDB.php";
        $userObj = new UserDB();
        $page = "insert.php";
        if (isset($_GET['id']))
            $page = "update.php";
        else
            $page = "insert.php";

        include "./model/user/$page";

        include "./model/user/findAll.php";

    ?>
</div>