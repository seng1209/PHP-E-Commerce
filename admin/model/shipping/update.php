<?php
    $image = $shipping_name = $price = $file_name = $temp_name = $extension = $uuid = $name = $folder = $imageFileType = "";

    $id = $_GET['id'];

    $row = $shippingObj->read($id);
    if($row){
        $image = $row['image'];
        $shipping_name = $row['shipping_name'];
        $price = $row['price'];
    }

    if(isset($_POST['modify'])){
        $shipping_name = $_POST['shipping_name'];
        $price = $_POST['price'];
        $file_name = $_FILES['image']['name'];
        
        if(!Validator::notEmpty($shipping_name)){
            die("Shipping Name is require!");
        }
        
        if(!Validator::notEmpty($price)){
            die("Price is require!");
        }

        if(Validator::notEmpty($file_name)){
            $temp_name = $_FILES['image']['tmp_name'];
            $extension = explode(".", $file_name);
            $uuid = gen_uuid();
            $name = $uuid . "." . $extension[1];
            $folder = "uploads/images/shipping/" . $name;
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

        try{
            if(!$shippingObj->update($id, $name, $shipping_name, $price)){
                die("Failed to insert data.");
            }
        }catch(Exception $ex){
            echo $ex;
        }

        if(file_exists($image))
            if(unlink($image));
        
    }
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Shipping</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=shipping&id=<?=$row['shipping_id']?>" method="post" enctype="multipart/form-data">
                        <div class=" mb-3">
                            <label for="formFile" class="form-label">Images</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Shipping Name</label>
                            <input type="text" name="shipping_name" value="<?=$shipping_name?>" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Shipping Price</label>
                            <input type="text" name="price" value="<?=$price?>" class="form-control" />
                        </div>
                        <!-- <div class="mb-3">
                            <label for="#" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows=" 3"></textarea>
                        </div> -->
                        <button type="submit" name="modify" class="btn btn-primary">
                            Modify
                        </button>
                        <a href="index.php?p=shipping" class="btn btn-primary m-1">Create new Shipment Method?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>