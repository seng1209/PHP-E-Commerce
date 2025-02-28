<?php
global $db;
$id = $_GET['id'];
    $image = $product_name = $price = $category_id = $category = $brand_id = $brand = $description = $file_name = $temp_name = $extension = $uuid = $name = $folder = $imageFileType = $in_stock = "";

    $row = $db->read("categories AS c INNER JOIN products p ON c.category_id = p.category_id INNER JOIN brands b ON p.brand_id = b.brand_id", "p.product_id, p.image, p.product_name, p.price, p.category_id, p.brand_id, p.description, p.in_stock, c.category, b.brand", "product_id='$id'");
    if($row){
        $image = $row['image'];
        $product_name = $row['product_name'];
        $price = $row['price'];
        $category_id = $row['category_id'];
        $category = $row['category'];
        $brand_id = $row['brand_id'];
        $brand = $row['brand'];
        $description = $row['description'];
        $in_stock = $row['in_stock'];
    }

    if(isset($_POST['modify'])){
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
        $in_stock = $_POST['in_stock'];
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

            if (file_exists($image)) {
                unlink($image);
            }
        }else{
            $name = $image;
        }

        $data = [
            'image' => $name,
            'product_name' => $product_name,
            'price' => $price,
            'category_id' => $category_id,
            'brand_id' => $brand_id,
            'description' => $description,
            'in_stock' => $in_stock,
        ];

        try{
            if(!$db->update("products", $data, "product_id='$id'"))
                die("Cannot update this product");
        }catch(Exception $ex){
            die($ex->getMessage());
        }
    }
    
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Product</h5>
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
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
                            <option selected value="<?=$category_id?>"><?=$category?></option>
                            <?php
                                $categories = $db->read("categories");
                                foreach($categories as $row){
                            ?>
                            <option value="<?=$row['category_id']?>"><?=$row['category']?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <select class="form-select mb-3" name="brand" aria-label="Default select example">
                            <option selected value="<?=$brand_id?>"><?=$brand?></option>
                            <?php
                                $brands = $db->read("brands");
                                foreach($brands as $row){
                            ?>
                            <option value="<?=$row['brand_id']?>"><?=$row['brand']?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <div class="mb-3">
                            <label for="#" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"><?=$description?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">In Stock Quantity</label>
                            <input type="text" name="in_stock" value="<?=$in_stock?>" class="form-control" placeholder="Quantity"
                                require>
                        </div>
                        <input type="submit" name="modify" class="btn btn-primary" value="Modify" />
                        <a href="index.php?p=product" class="btn btn-primary m-1">Create new Product?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>