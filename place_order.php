<?php

session_start();
include('connection.php');

if(isset($_POST['checkout_btn'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "not paid";
    $order_date = date("Y-m-d");

    $conn->prepare("INSERT INTO orders(order_cost, order_status, user_name, user_email, user_phone, user_city, user_address, order_date)
                   VALUES(?,?,?,?,?,?,?,?)");
    $stmt->bind_param("isssisss", $order_cost, $order_status, $name, $email, $phone, $city, $address, $order_date);
    if(!$stmt->execute()){
        header("location: index.php");
        exit;
    }

    $order_id = $stmt -> insert_id;

    foreach($_SESSION['cart'] as $id=>$product){
        $product = $_SESSION['cart'][$id];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];
    }
}
?>