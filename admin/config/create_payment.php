<?php
require 'config.php';

global $apiContext;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

// Set payer information
$payer = new Payer();
$payer->setPaymentMethod('paypal');

// Set transaction details
$amount = new Amount();
$amount->setTotal('46.00'); // Total amount
$amount->setCurrency('USD');

$transaction = new Transaction();
$transaction->setAmount($amount);
$transaction->setDescription('Payment description');

// Create a redirect URL
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl('http://your-site.com/execute_payment.php?success=true')
    ->setCancelUrl('http://your-site.com/execute_payment.php?success=false');

// Create payment
$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions([$transaction]);

try {
    $payment->create($apiContext);
    header("Location: " . $payment->getApprovalLink());
    exit;
} catch (Exception $ex) {
    // Handle error
    echo "Error: " . $ex->getMessage();
}
?>