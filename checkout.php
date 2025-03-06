<?php
global $db;

if (isset($_POST['pay'])) {
    $city = $_POST['city'];
    $khan = $_POST['khan'];
    $snagkat = $_POST['sangkat'];
    $village = $_POST['village'];
    $street_address = $_POST['street_address'];
    $shipment_method_id = $_POST['shipment'];

    $shipping_data = [
        'shipment_method_id' => $shipment_method_id,
        'user_id' => 3,
        'city' => $city,
        'khan' => $khan,
        'snagkat' => $snagkat,
        'village' => $village,
        'street_address' => $street_address,
    ];

    print_r($shipping_data);

    try {
//        if (!$db->create("shipping", $shipping_data))
//            die("Create shipping failed");
    }catch (Exception $e){
        echo $e->getMessage();
    }
}

?>

<div class="container-fluid">
                        <div id="paypal-button-container"></div>
</div>

<script src="https://www.paypal.com/sdk/js?client-id=AQfAeIbwBEwlhXqIbD8EjsaNnn8h53yNV-pz0IG707-iD42l8rjUET8bTPrBWHGtDhd99Q8ZRSVFRhwG&components=buttons&currency=USD"></script>
<script>
    // Ensure the PayPal SDK is loaded before using it
    if (typeof paypal !== "undefined") {
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: "'.$sub_total.'" // Amount to be charged
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert("Transaction completed by " + details.payer.name.given_name);
                    $_SESSION['cart'] = [];
                    window.location.reload();
                });
            },
        }).render("#paypal-button-container"); // Display the PayPal button
    } else {
        console.error("PayPal SDK not loaded.");
    }
</script>