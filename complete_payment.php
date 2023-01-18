<?php

session_start();
include("connection.php");

if(isset($_GET['transaction_id']) && isset($_SESSION['order_id'])){


$order_status = "paid";
$order_id = $_SESSION['order_id'];
$payment_date = date("Y-m-d");
$transaction_id = $_GET['transaction_id'];

//status-ul comenzii se actualizeaza la valoarea "paid"
$stmt = $conn->prepare("update orders set order_status = ? where order_id = ?");
$stmt->bind_param("si",$order_status,$order_id);
$stmt->execute();

//se inregistreaza datele de plata

$stmt1 = $conn->prepare("insert into payments (order_id, transaction_id,payment_date) values(?,?,?) ");
$stmt1->bind_param("iss", $order_id, $transaction_id, $payment_date);
$stmt1->execute();

header("location: thank_you.php?success_message=Vă mulțumim că ați ales magazinul nostru");
exit;
}
else{
    header("location: index.php");
    exit;
   
}
?>