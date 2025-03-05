<?php
require 'vendor/autoload.php'; // Load Composer's autoloader

define('CLIENT_ID', 'AQfAeIbwBEwlhXqIbD8EjsaNnn8h53yNV-pz0IG707-iD42l8rjUET8bTPrBWHGtDhd99Q8ZRSVFRhwG');
define('CLIENT_SECRET', 'EHKPhJGJvf4EASLc9WwA_gUacZ8uvTJN4OLGYiZ4RZU4WX1oVLZEzQOFgAzVwLEE4YNXe69siNvzRK-7');

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        CLIENT_ID,
        CLIENT_SECRET
    )
);

$apiContext->setConfig([
    'mode' => 'sandbox', // Use 'live' for production
]);
?>