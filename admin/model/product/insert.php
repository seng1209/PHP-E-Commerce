<?php
    $image = $product_name = $price = $category_id = $category = $brand_id = $brand = $description = $file_name = $temp_name = $extension = $uuid = $name = $folder = $imageFileType = "";
    $in_stock = true;

    $sqlCategory = "SELECT * FROM categories";
    $sqlBrand = "SELECT * FROM brands";

    if(isset($_POST['submit'])){
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        if(isset($_POST['category']))
            $category_id = $_POST['category'];
        if(isset($_POST['brand']))
            $brand_id = $_POST['brand'];
        $description = $_POST['description'];
        $file_name = $_FILES['image']['name'];

        if(!Validator::notEmpty($product_name)){
            die("Product Name is require!");
        }
        
        if(!Validator::notEmpty($price)){
            die("Price is requird!");
        }

        if(!Validator::notEmpty($category_id)){
            die("Category ID is require!");
        }

        if(!Validator::notEmpty($brand_id)){
            die("Brand ID is require!");
        }

        if(!Validator::notEmpty($description)){
            die("Description is require!");
        }

        if(Validator::notEmpty($file_name)){
            $temp_name = $_FILES['image']['tmp_name'];
            $extension = explode(".", $file_name);
            $uuid = gen_uuid();
            $name = $uuid . "." . $extension[1];
            $folder = "uploads/images/products/" . $name;
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
            $sql =  "INSERT INTO products(image, product_name, price, category_id, brand_id, description, in_stock) VALUES ('$name', '$product_name', '$price', '$category_id', '$brand_id', '$description', '$in_stock')";
            if(!$conn->query($sql)){
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
            <h5 class="card-title fw-semibold mb-4">Product</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=product" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" name="image" id="formFile" require>
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" placeholder="Product Name"
                                require>
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" placeholder="Price" require>
                        </div>
                        <select class="form-select mb-3" name="category" aria-label="Default select example">
                            <option selected disabled>Category</option>
                            <?php
                                $result = $conn->query($sqlCategory);
                                if($result->num_rows > 0)
                                {
                                    while($row = $result->fetch_assoc()){
                            ?>
                            <option value=" <?=$row['category_id']?>"><?=$row['category']?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                        <select class="form-select mb-3" name="brand" aria-label="Default select example">
                            <option selected disabled>Brand</option>
                            <?php
                                $result = $conn->query($sqlBrand);
                                if($result->num_rows > 0)
                                {
                                    while($row = $result->fetch_assoc()){
                            ?>
                            <option value=" <?=$row['brand_id']?>"><?=$row['brand']?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                        <div class="mb-3">
                            <label for="#" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>