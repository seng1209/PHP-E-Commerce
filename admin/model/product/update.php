<?php
    $id = $_GET['id'];
    $image = $product_name = $price = $category_id = $category = $brand_id = $brand = $description = $file_name = $temp_name = $extension = $uuid = $name = $folder = $imageFileType = "";
    $in_stock = true;

    $sql = "SELECT * FROM products WHERE product_id = $id";
    $sqlCategory = "SELECT * FROM categories";
    $sqlBrand = "SELECT * FROM brands";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $image = $row['image'];
        $product_name = $row['product_name'];
        $price = $row['price'];
        $category_id = $row['category_id'];
        $brand_id = $row['brand_id'];
        $description = $row['description'];

        $sql2 = "SELECT * FROM categories WHERE category_id = $category_id";
        $result2 = $conn->query($sql2);
        if($result2->num_rows > 0){
            $row2 = $result2->fetch_assoc();
            $category = $row2['category'];
        }

        $sql3 = "SELECT * FROM brands WHERE brand_id = $brand_id";
        $result3 = $conn->query($sql3);
        if($result3->num_rows > 0){
            $row3 = $result3->fetch_assoc();
            $brand = $row3['brand'];
        }
    }

    if(isset($_POST['submit'])){
        $image = $row['image'];
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        if(Validator::notEmpty($_POST['category']))
            $category_id = $_POST['category'];
        else
            $category_id = $row['category_id'];
        if(Validator::notEmpty($_POST['brand']))
            $brand_id = $_POST['brand'];
        else
            $brand_id = $row['brand_id'];
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
            $sqlUpdate = "UPDATE products SET image='$name', product_name='$product_name', price='$price', category_id='$category_id', brand_id='$brand_id', description='$description' WHERE product_id=$id";
            if(!$conn->query($sqlUpdate) === TRUE)
                die("Cannot update this product");
        }catch(Exception $ex){
            echo $ex;
        }

        echo "<h1>$image</h1>";
        echo "<h1>$product_name</h1>";
        echo "<h1>$price</h1>";
        echo "<h1>$category_id</h1>";
        echo "<h1>$brand_id</h1>";
        echo "<h1>$description</h1>";
    }
    
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Product</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=product&id=<?=$row['product_id']?>" method="post"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" name="image" id="formFile" require>
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Product Name</label>
                            <input type="text" name="product_name" value="<?=$product_name?>" class="form-control"
                                placeholder="Product Name" require>
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Price</label>
                            <input type="number" name="price" value="<?=$price?>" class="form-control"
                                placeholder="Price" require>
                        </div>
                        <select class="form-select mb-3" name="category" aria-label="Default select example">
                            <option selected><?=$category?></option>
                            <?php
                                $result = $conn->query($sqlCategory);
                                if($result->num_rows > 0)
                                {
                                    while($row = $result->fetch_assoc()){
                            ?>
                            <option value="<?=$row['category_id']?>"><?=$row['category']?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                        <select class="form-select mb-3" name="brand" aria-label="Default select example">
                            <option selected><?=$brand?></option>
                            <?php
                                $result = $conn->query($sqlBrand);
                                if($result->num_rows > 0)
                                {
                                    while($row = $result->fetch_assoc()){
                            ?>
                            <option value="<?=$row['brand_id']?>"><?=$row['brand']?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                        <div class="mb-3">
                            <label for="#" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"><?=$description?></textarea>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>