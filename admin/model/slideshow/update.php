<?php

global $db;

$ss_id = $image = $title = $sub_title = $link = $enable = $order_number = $file_name = $temp_name = $extension = $uuid =
$name = $folder = $imageFileType = "";

$id = $_GET['id'];

$row = $db->read("slideshow", "*", "ss_id = '$id'");

if ($row){
    $image = $row['image'];
    $title = $row['title'];
    $sub_title = $row['sub_title'];
    $link = $row['link'];
    $enable = $row['enable'];
    $order_number = $row['order_number'];
}

if (isset($_POST['modify'])){
    $title = $_POST['title'];
    $sub_title = $_POST['sub_title'];
    $link = $_POST['link'];
    $enable = $_POST['enable'];
    $order_number = $_POST['order_number'];
    $file_name = $_FILES['image']['name'];

    if (!Validator::notEmpty($title)) {
        die("Title is required.");
    }

    if (!Validator::notEmpty($sub_title)) {
        die("Subtitle is required.");
    }

    if (!Validator::notEmpty($link)) {
        die("Link is required.");
    }

    if (!Validator::notEmpty($enable)) {
        die("Enable is required.");
    }

    if (!Validator::notEmpty($order_number)) {
        die("Order number is required.");
    }

    if (Validator::notEmpty($file_name)) {
        $temp_name = $_FILES['image']['tmp_name'];
        $extension = explode(".", $file_name);
        $uuid = gen_uuid();
        $name = $uuid . "." . $extension[1];
        $folder = "uploads/images/slider/" . $name;
        $imageFileType = strtolower(pathinfo($folder, PATHINFO_EXTENSION));

        if (!move_uploaded_file($temp_name, $folder))
            die("Failed to upload image.");

    }else{
        $name = $image;
    }

    $data = [
        'image' => $name,
        'title' => $title,
        'sub_title' => $sub_title,
        'link' => $link,
        'enable' => $enable,
        'order_number' => $order_number,
    ];

    try {
        if (!$db->update("slideshow", $data, "ss_id = '$id'"))
            die("Failed to update slideshow.");
    }catch (Exception $e){
        echo $e->getMessage();
    }

}

?>


<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Slider</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=slideshow&id=<?=$id?>" method="post" enctype="multipart/form-data">
                        <div class=" mb-3">
                            <label for="formFile" class="form-label">Images</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Title</label>
                            <input type="text" name="title" value="<?=$title?>" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Subtitle</label>
                            <input type="text" name="sub_title" value="<?=$sub_title?>" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Link</label>
                            <textarea class="form-control" name="link" rows=" 3"><?=$link?></textarea>
                        </div>
                        <select class="form-select" name="enable" aria-label="Enable">
                            <option selected value="<?=$enable?>"><?=$enable?></option>
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                        </select>
                        <div class="mb-3">
                            <label for="#" class="form-label">Order Number</label>
                            <input type="text" name="order_number" value="<?=$order_number?>" class="form-control" />
                        </div>
                        <button type="submit" name="modify" class="btn btn-primary">
                            Modify
                        </button>
                        <a href="index.php?p=sliddeshow" class="btn btn-primary m-1">Create new Slideshow</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
