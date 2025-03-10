<?php
session_start();
require "./lib/Database.php";
$db = new Database();
require "./lib/Auth.php";
$auth = new Auth();

if ($auth->checkRememberMe())
{
    header('Location: ./index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            die("Please enter username and password.");
        }

        if ($auth->login($username, $password)) {
            if ($_SESSION['role'] == 'admin')
                header('Location: ./index.php');
            if ($_SESSION['role'] == 'customer')
                header('Location: ../index.php');
        }

        if (isset($_POST['remember_me'])) {
            try {
                $auth->rememberMe($_SESSION['user_id']);
            }catch (Exception $e) {
                echo $e->getMessage();
            }
        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include "./components/head.php" ?>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="./assets/images/logos/dark-logo.svg" width="180" alt="" />
                                </a>
                                <p class="text-center">Your Social Campaigns</p>
                                <form action="login.php" method="post">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id=""
                                            aria-describedby="emailHelp" />
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" />
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" name="remember_me"
                                                   value="remember_me" id="flexCheckChecked" />
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Remember me
                                            </label>
                                        </div>
                                        <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
                                    </div>
                                    <input type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="login" value="Log In" />
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
                                        <a class="text-primary fw-bold ms-2" href="./register.php">Create an account</a>
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