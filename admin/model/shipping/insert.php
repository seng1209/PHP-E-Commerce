<?php
    global $db;
    $shipping_id = $shipping_date = $shipment_method_id = $user_id = $city = $khan = $sangkat = $village =
    $street_address = $file_name = $temp_name = $extension = $uuid = $name = $folder = $imageFileType = "";

    if(isset($_POST['submit'])){
        $shipment_method_id = $_POST['shipment_method_id'];
        $user_id = $_POST['user_id'];
        $city = $_POST['city'];
        $khan = $_POST['khan'];
        $sangkat = $_POST['sangkat'];
        $village = $_POST['village'];
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
                'khan' => $khan,
                'sangkat' => $sangkat,
                'village' => $village,
                'street_address' => $street_address,
        ];

        try{
            if(!$db->create("shipping", $data)){
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
            <h5 class="card-title fw-semibold mb-4">Shipping</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=shipping" method="post" enctype="multipart/form-data">
                        <select class="form-select mb-3" name="shipment_method_id" aria-label="Default select example">
                            <option selected disabled>Shipment Methods</option>
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
                            <option selected disabled>Users</option>
                            <?php
                            $users = $db->read("users");
                            foreach($users as $row){
                                ?>
                                <option value=" <?=$row['user_id']?>"><?=$row['username']?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <div class="mb-3">
                            <label for="#" class="form-label">City</label>
                            <input type="text" name="city" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Khan</label>
                            <input type="text" name="khan" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Sangkat</label>
                            <input type="text" name="sangkat" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Village</label>
                            <input type="text" name="village" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Street Address</label>
                            <input type="text" name="street address" class="form-control" />
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