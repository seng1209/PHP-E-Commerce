<?php
global $db;

$sub_total = $total = $shipment_price = 0;

//$user_id = $_SESSION['user_id'];
$user_id = 3;

$shipping_data = [];

$payment_data = [];

$order_data = [];

$order_product_data = [];

if (isset($_POST['pay'])) {
    // shipping
    $city = $_POST['city'];
    $street_address = $_POST['street_address'];
    $shipment_method_id = $_POST['shipment'];

    // payment
    $payment_method_id = $_POST['payment'];

    // cost
    $row = $db->read("shipment_methods", "*", "shipment_method_id = '$shipment_method_id'");
    if ($row)
        $shipment_price = $row['price'];
    $sub_total = $_POST['sub_total'];
    $total = $sub_total + $shipment_price;

    $shipping_data = [
        'shipment_method_id' => $shipment_method_id,
        'user_id' => 3,
        'city' => $city,
        'street_address' => $street_address,
    ];

    $payment_data = [
            'payment_method_id' => $payment_method_id,
            'amount' => $total,
    ];

    $order_data = [
        "user_id" => $user_id,
        "total_amount" => 0
    ];

}

?>

<div class="container-fluid">
    <div style="
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full height of the viewport */
            margin: 0;
            font-family: Arial, sans-serif;
            ">
        <?php
        echo '<p>Use one of the payment buttons or the credit card form below for your payment of $'.$total.'.</p>';
        ?>
        <span style="text-align: center;">
            <div id="paypal-button-container"></div>
        </span>
    </div>
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
                            value: "<?=$total?>" // Amount to be charged
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert("Transaction completed by " + details.payer.name.given_name);
                    <?php
                    try {
                        if (!$db->create("orders",$order_data))
                            die("Failed to create order");

                        $order_id = $db->last_id("orders", "order_id");

                        insert_order_product($db, $order_id);

                        if (!$db->create("shipping", $shipping_data))
                            die("Create shipping failed");
                        if (!$db->create("payments", $payment_data))
                            die("Create payment failed");
                    }catch (Exception $e){
                        echo $e->getMessage();
                    }
                    $_SESSION['cart'] = [];
                    ?>
                    window.location.href="index.php?p=home";
                });
            },
        }).render("#paypal-button-container"); // Display the PayPal button
    } else {
        console.error("PayPal SDK not loaded.");
    }
</script>

<?php



function insert_order_product($db, $order_id)
{
    foreach ($_SESSION['cart'] as $key => $value) {
        $order_product_data = [
            "order_id" => $order_id,
            "product_id" => $value['product_id'],
            "quantity" => $value['quantity'],
            "amount" => $value['price'] * $value['quantity'],
        ];
        if (!$db->create("order_products", $order_product_data))
            die("Failed to create order product");
        $total_amount = $db->total_amount("order_products", "amount", "order_id = $order_id");
        if (!$db->update("orders" , ["total_amount" => $total_amount], "order_id = $order_id"))
            die("Failed to update total amount");
    }

}
?>