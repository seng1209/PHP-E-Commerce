<?php
global $db;
$shipping_id = $shipping_date = $shipment_method_id = $shipment_method = $user_id = $city =
$street_address = $file_name = $temp_name = $extension = $uuid = $name = $folder = $imageFileType = "";

$id = $_GET['id'];

$row = $db->read("shipping", "*", "shipping_id = '$id'");
if ($row){
    $shipping_date = $row["shipping_date"];
    $shipment_method_id = $row["shipment_method_id"];
    $user_id = $row["user_id"];
    $city = $row["city"];
    $khan = $row["khan"];
    $sangkat = $row["sangkat"];
    $village = $row["village"];
    $street_address = $row["street_address"];
}

$row1 = $db->read("shipment_methods", "*", "shipment_method_id = '$shipment_method_id'");
if ($row1){
    $shipment_method  = $row1["name"];
}

$row2 = $db->read("users", "*", "user_id = '$user_id'");
if ($row2){
    $username  = $row2["username"];
}

if(isset($_POST['modify'])){
    $shipment_method_id = $_POST['shipment_method_id'];
    $user_id = $_POST['user_id'];
    $city = $_POST['city'];
    $street_address = $_POST['street_address'];

    if(!Validator::notEmpty($shipment_method_id)){
        die("Shipment Method ID is require!");
    }

    if (!Validator::notEmpty($user_id)){
        die("User ID is require!");
    }

    $data = [
        'shipment_method_id' => $shipment_method_id,
        'user_id' => $user_id,
        'city' => $city,
        'street_address' => $street_address,
    ];

    try{
        if(!$db->update("shipping", $data, "shipping_id = '$id'")){
            die("Failed to insert data.");
        }
    }catch(Exception $ex){
        echo $ex;
    }

}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Shipping</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=shipping&id=<?=$id?>" method="post" enctype="multipart/form-data">
                        <select class="form-select mb-3" name="shipment_method_id" aria-label="Default select example">
                            <option selected disabled value="<?=$shipment_method_id?>"><?=$shipment_method?></option>
                            <?php
                            $shipment_methods = $db->read("shipment_methods");
                            foreach($shipment_methods as $row){
                                ?>
                                <option value=" <?=$row['shipment_method_id']?>"><?=$row['name']?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <select class="form-select mb-3" name="user_id" aria-label="Default select example">
                            <option selected disabled value="<?=$user_id?>"><?=$username?></option>
                            <?php
                            $users = $db->readBy("users", "*", "role = 'customer'");
                            foreach($users as $row){
                                ?>
                                <option value=" <?=$row['user_id']?>"><?=$row['username']?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <div class="mb-3">
                            <label for="#" class="form-label">City</label>
                            <input type="text" name="city" value="<?=$city?>" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Street Address</label>
                            <input type="text" name="street address" value="<?=$street_address?>" class="form-control" />
                        </div>
                        <button type="submit" name="modify" class="btn btn-primary">
                            Modify
                        </button>
                        <a href="index.php?p=shipping" class="btn btn-primary m-1">Create new Shipping</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>