<?php
global $db;
$payment_method_id = $image = $payment_method = $price = $description = $file_name = $temp_name = $extension =
$uuid = $name = $folder = $imageFileType = "";

if (isset($_POST["submit"])) {
    $payment_method = $_POST["payment-method"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $file_name = $_FILES["image"]["name"];

    if (!Validator::notEmpty($payment_method)) {
        die("Payment Method name cannot be empty!");
    }

    if (!Validator::notEmpty($price)) {
        die("Price name cannot be empty!");
    }

    if (!Validator::notEmpty($description)) {
        die("Description cannot be empty!");
    }

    if(Validator::notEmpty($file_name)){
        $temp_name = $_FILES['image']['tmp_name'];
        $extension = explode(".", $file_name);
        $uuid = gen_uuid();
        $name = $uuid . "." . $extension[1];
        $folder = "uploads/images/payment_methods/" . $name;
        $imageFileType = strtolower(pathinfo($folder, PATHINFO_EXTENSION));
    }else{
        die("Image is require!");
    }

    if(Validator::checkFileSize($_FILES['image']['size'])){
        die("Image is large size 5MB!");
    }

    if(!Validator::fileFormats($imageFileType)){
        die("Sorry, only JPG, JPEG, PNG & WEBP files are allowed.");
    }

    $data = [
            'image' => $name,
            'name' => $payment_method,
            'price' => $price,
            'description' => $description,
    ];

    try {
        if (!$db->create("payment_methods", $data)){
            die("Failed to create shipment method!");
        }
        if (!move_uploaded_file($temp_name, $folder)) {
            die("Failed to upload image.");
        }
    }catch (Exception $ex){
        echo $ex->getMessage();
        return false;
    }
}

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Payment Method</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=payment-method" method="post" enctype="multipart/form-data">
                        <div class=" mb-3">
                            <label for="formFile" class="form-label">Images</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Payment Method</label>
                            <input type="text" name="payment-method" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Price</label>
                            <input type="text" name="price" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows=" 3"></textarea>
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