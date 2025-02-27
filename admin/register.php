<!DOCTYPE html>
<html lang="en">

<?php
    include "./components/head.php";

    require "./lib/Database.php";
    require "./lib/UserDB.php";

    $image = $username = $password = $email = $phone = $address = $role = $file_name =
    $temp_name = $extension = $uuid = $name = $folder = $imageFileType = "";

    $userObj = new UserDB();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {
            $image = $_FILES["image"]["name"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $role = 'customer';

            echo $image . "<br/>";
            echo $username . "<br/>";
            echo $password . "<br/>";
            echo $email . "<br/>";
            echo $phone . "<br/>";
            echo $address . "<br/>";
            echo $role . "<br/>";
        }
    }

?>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-4">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="./index.php?p=dashboard"
                                    class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="./assets/images/logos/dark-logo.svg" width="180" alt="" />
                                </a>
                                <p class="text-center">Your Social Campaigns</p>
                                <form>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Upload Image</label>
                                        <input class="form-control" type="file" name="image" id="formFile" require>
                                    </div>
                                    <div style="display: flex">
                                        <div class="w-full p-1" style="width: 100%;">
                                            <div class="mb-3">
                                                <label for="exampleInputtext1" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="exampleInputtext1"
                                                       aria-describedby="textHelp" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp" />
                                            </div>
                                        </div>
                                        <div class="w-full p-1" style="width: 100%;">
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="#" class="form-label">Address</label>
                                        <textarea class="form-control" name="address" rows=" 3"></textarea>
                                    </div>
                                    <a href="./index.php?p=dashboard"
                                        class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign
                                        Up</a>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                        <a class="text-primary fw-bold ms-2" href="./login.php">Sign
                                            In</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>