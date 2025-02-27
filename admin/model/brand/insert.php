<?php

global $brandObj;
$image = $brand = $description = $file_name = $temp_name = $extension = $uuid = $name = $folder = $imageFileType = "";
    
    if(isset($_POST['submit'])){
        $brand = $_POST['brand'];
        $description = $_POST['description'];
        $file_name = $_FILES['image']['name'];
        
        if(!Validator::notEmpty($brand)){
            die("Brand is require!");
        }
        
        if(!Validator::notEmpty($description)){
            die("Description is require!");
        }

        if(Validator::notEmpty($file_name)){
            $temp_name = $_FILES['image']['tmp_name'];
            $extension = explode(".", $file_name);
            $uuid = gen_uuid();
            $name = $uuid . "." . $extension[1];
            $folder = "uploads/images/brands/" . $name;
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

        try{
            if(!$brandObj->create($name, $brand, $description)){
                die("Failed to insert data.");
            }
            if (!move_uploaded_file($temp_name, $folder)) {
                die("Failed to upload image.");
            }
        }catch(Exception $ex){
            echo $ex;
        }
        
    }
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Brand</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=brand" method="post" enctype="multipart/form-data">
                        <div class=" mb-3">
                            <label for="formFile" class="form-label">Images</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control" />
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