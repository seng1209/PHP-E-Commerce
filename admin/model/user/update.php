<?php

global $db;
$image = $username = $password = $email = $phone = $address = $role = $file_name =
$temp_name = $extension = $uuid = $name = $folder = $imageFileType = "";

$id = $_GET['id'];

$row = $db->read("users", "*" , "user_id = '$id'");
if ($row){
    $image = $row['image'];
    $username = $row['username'];
    $password = $row['password'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
    $role = $row['role'];
}

if (isset($_POST["modify"])) {
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

        if (Validator::checkFileSize($_FILES["image"]["size"])) {
            die("Image is larger size 5MB");
        }

        if (!Validator::fileFormats($imageFileType)){
            die("Sorry, only JPG, JPEG, PNG & WEBP files are allowed.");
        }

        if (!move_uploaded_file($temp_name, $folder)){
            die("Fail to move uploaded file");
        }

        if (file_exists($image))
            unlink($image);
    }else
        $name = $image;

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
        if (!$db->update("users", $data, "user_id = '$id'")) {
            die("Fail to update user");
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
                    <form action="index.php?p=user&id=<?=$id?>" method="post" enctype="multipart/form-data">
                        <div class=" mb-3">
                            <label for="formFile" class="form-label">Images</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Username</label>
                            <input type="text" name="username" value="<?=$username?>" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Password</label>
                            <input type="password" name="passwd" value="<?=$password?>" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Email</label>
                            <input type="email" name="email" value="<?=$email?>" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Phone</label>
                            <input type="text" name="phone" value="<?=$phone?>" class="form-control" />
                        </div>
                        <label for="#" class="form-label">Role</label>
                        <select class="form-select" name="role" aria-label="Default select example">
                            <option value="<?=$role?>"><?=$role?></option>
                            <option value="customer">Customer</option>
                            <option value="admin">Admin</option>
                        </select>
                        <div class="mb-3">
                            <label for="#" class="form-label">Address</label>
                            <textarea class="form-control" name="address" rows=" 3"><?=$address?></textarea>
                        </div>
                        <button type="submit" name="modify" class="btn btn-primary">
                            Modify
                        </button>
                        <a href="index.php?p=user" class="btn btn-primary m-1">Create new User?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
