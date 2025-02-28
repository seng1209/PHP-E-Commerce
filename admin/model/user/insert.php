<?php

    global $db;
    $image = $username = $password = $email = $phone = $address = $role = $file_name =
    $temp_name = $extension = $uuid = $name = $folder = $imageFileType = "";

    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = $_POST["passwd"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $role = $_POST["role"];
        $fileName = $_FILES["image"]["name"];

        if (!Validator::notEmpty($username)) {
            die("Username is required");
        }

        if (!Validator::notEmpty($password)) {
            die("Password is required");
        }

        if (!Validator::notEmpty($email)) {
            die("Email is required");
        }

        if (!Validator::notEmpty($phone)) {
            die("Phone is required");
        }

        if (!Validator::notEmpty($address)) {
            die("Address is required");
        }

        if (!Validator::notEmpty($role)) {
            die("Role is required");
        }

        if (Validator::notEmpty($fileName)) {
            $temp_name = $_FILES["image"]["tmp_name"];
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $uuid = gen_uuid();
            $name = $uuid . "." . $extension;
            $folder = "uploads/images/users/" . $name;
            $imageFileType = strtolower(pathinfo($folder, PATHINFO_EXTENSION));
        }else
            die("Image is required");

        if (Validator::checkFileSize($_FILES["image"]["size"])) {
            die("Image is larger size 5MB");
        }

        if (!Validator::fileFormats($imageFileType)){
            die("Sorry, only JPG, JPEG, PNG & WEBP files are allowed.");
        }

        $data = [
                'image' => $name,
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'role' => $role,
        ];

        try {
            if (!$db->create('users', $data)){
                die("Fail to insert user");
            }
            if (!move_uploaded_file($temp_name, $folder)){
                die("Fail to move uploaded file");
            }
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">User</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=user" method="post" enctype="multipart/form-data">
                        <div class=" mb-3">
                            <label for="formFile" class="form-label">Images</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Password</label>
                            <input type="password" name="passwd" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" />
                        </div>
                        <label for="#" class="form-label">Role</label>
                        <select class="form-select" name="role" aria-label="Default select example">
                            <option selected value="customer">Customer</option>
                            <option value="admin">Admin</option>
                        </select>
                        <div class="mb-3">
                            <label for="#" class="form-label">Address</label>
                            <textarea class="form-control" name="address" rows=" 3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
