<?php
    $id = $_GET['id'];
    $image = $category = $description = $file_name = $temp_name = $extension = $uuid = $name = $folder = $imageFileType = "";
    $sql = "SELECT * FROM categories WHERE category_id = $id";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $image = $row['image'];
        $category = $row['category'];
        $description = $row['description'];
    }

    if(isset($_POST['submit'])){
        $image = $row['image'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $file_name = $_FILES['image']['name'];

        if(Validator::notEmpty($file_name)){
            $temp_name = $_FILES['image']['tmp_name'];
            $extension = explode(".", $file_name);
            $uuid = gen_uuid();
            $name = $uuid . "." . $extension[1];
            $folder = "uploads/images/categories/" . $name;
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
            $sql = "UPDATE categories SET image = '$name', category = '$category', description = '$description' WHERE category_id = $id";
            if(!$conn->query($sql) === TRUE)
                die("Cannot update this category.");
        }catch(Exception $ex){
            echo $ex;
        }
    }
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Category</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=category&id=<?=$row['category_id']?>" method="post"
                        enctype="multipart/form-data">
                        <div class=" mb-3">
                            <label for="formFile" class="form-label">Images</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Category</label>
                            <input type="text" name="category" value="<?=$category?>" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows=" 3"><?=$description?></textarea>
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