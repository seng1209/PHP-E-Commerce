<?php
require 'config.php';

global $apiContext;

if (isset($_GET['success']) && $_GET['success'] == 'true') {
    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $apiContext);

    // Execute payment
    $execution = new \PayPal\Api\PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);

    try {
        $result = $payment->execute($execution, $apiContext);
        echo "Payment Successful!";
    } catch (Exception $ex) {
        // Handle error
        echo "Error: " . $ex->getMessage();
    }
} else {
    echo "Payment canceled.";
}
?>