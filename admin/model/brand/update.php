<?php

global $brandObj;
$id = $_GET['id'];
    $image = $brand = $description = $file_name = $temp_name = $extension = $uuid = $name = $folder = $imageFileType = "";

    $b = $brandObj->read($id);
    if($b){
        $image = $b['image'];
        $brand = $b['brand'];
        $description = $b['description'];
    }
    
    if(isset($_POST['modify'])){
        $image = $b['image'];
        $brand = $_POST['brand'];
        $description = $_POST['description'];
        $file_name = $_FILES['image']['name'];
        
        if(Validator::notEmpty($file_name)){
            $temp_name = $_FILES['image']['tmp_name'];
            $extension = explode(".", $file_name);
            $uuid = gen_uuid();
            $name = $uuid . "." . $extension[1];
            $folder = "uploads/images/brands/" . $name;
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
            if(!$brandObj->update($id, $name, $brand, $description) === TRUE){
                die("Cannot update.");
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
            <h5 class="card-title fw-semibold mb-4">Brand</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=brand&id=<?=$b['brand_id'];?>" method="post"
                        enctype="multipart/form-data">  
                        <div class=" mb-3">
                            <label for="formFile" class="form-label">Images</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Brand</label>
                            <input type="text" name="brand" value="<?=$brand?>" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows=" 3"><?=$description?></textarea>
                        </div>
                        <button type=" submit" name="modify" class="btn btn-primary" id="modify">
                            Modify
                        </button>
                        <a href="index.php?p=brand" class="btn btn-primary m-1">Create New Brand?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>