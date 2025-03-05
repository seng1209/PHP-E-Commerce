<?php
global $db;

$ss_id = $image = $title = $sub_title = $link = $enable = $order_number = $file_name = $temp_name = $extension = $uuid =
$name = $folder = $imageFileType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $title = $_POST['title'];
        $sub_title = $_POST['sub_title'];
        $link = $_POST['link'];
        $enable = $_POST['enable'];
        $order_number = $_POST['order_num'];
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
        }else{
            die("Image is required.");
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
            if (!$db->create("slideshow", $data))
                die("Failed to create slideshow.");
            if (!move_uploaded_file($temp_name, $folder))
                die("Failed to move uploaded image.");
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Slider</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=slideshow" method="post" enctype="multipart/form-data">
                        <div class=" mb-3">
                            <label for="formFile" class="form-label">Images</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Subtitle</label>
                            <input type="text" name="sub_title" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Link</label>
                            <textarea class="form-control" name="link" rows=" 3"></textarea>
                        </div>
                        <select class="form-select" name="enable" aria-label="Enable">
                            <option selected value="1">Enable</option>
                            <option value="0">Disable</option>
                        </select>
                        <div class="mb-3">
                            <label for="#" class="form-label">Order Number</label>
                            <input type="text" name="order_num" class="form-control" />
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