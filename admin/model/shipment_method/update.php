<?php
global $shipmentMethodObj;
$shipment_method_id = $image = $shipment_method = $price = $description = $file_name = $temp_name = $extension =
$uuid = $name = $folder = $imageFileType = "";

$id = $_GET['id'];
$row = $shipmentMethodObj->read($id);

if ($row){
    $image = $row['image'];
    $shipment_method = $row['name'];
    $price = $row['price'];
    $description = $row['description'];
}

if (isset($_POST["modify"])) {
    $shipment_method = $_POST["shipment-method"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $file_name = $_FILES["image"]["name"];

    if (!Validator::notEmpty($shipment_method)) {
        die("Shipment Method name cannot be empty!");
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
        $folder = "uploads/images/shipment_method/" . $name;
        $imageFileType = strtolower(pathinfo($folder, PATHINFO_EXTENSION));

        if(Validator::checkFileSize($_FILES['image']['size'])){
            die("Image is large size 5MB!");
        }

        if(!Validator::fileFormats($imageFileType)){
            die("Sorry, only JPG, JPEG, PNG & WEBP files are allowed.");
        }

        if (!move_uploaded_file($temp_name, $folder)) {
            die("Failed to upload image.");
        }
    }else{
        $name = $image;
    }

    try {
        if (!$shipmentMethodObj->update($id, $name, $shipment_method, $price, $description)){
            die("Failed to create shipment method!");
        }
    }catch (Exception $ex){
        echo $ex->getMessage();
        return false;
    }

    if (file_exists($image))
        if (unlink($image));
}

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Shipment Method</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=shipment-method&id=<?=$id?>" method="post" enctype="multipart/form-data">
                        <div class=" mb-3">
                            <label for="formFile" class="form-label">Images</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Shipment Method</label>
                            <input type="text" name="shipment-method" value="<?=$shipment_method?>" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Price</label>
                            <input type="text" name="price" value="<?=$price?>" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows=" 3"><?=$description?></textarea>
                        </div>
                        <button type="submit" name="modify" class="btn btn-primary">
                            Modify
                        </button>
                        <a href="index.php?p=shipment-method" class="btn btn-primary m-1">Create new Shipment Method</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>