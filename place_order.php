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

    $stmt = $conn->prepare("INSERT INTO orders(order_cost, order_status, user_name, user_email, user_phone, user_city, user_address, order_date)
                   VALUES(?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssisss", $order_cost, $order_status, $name, $email, $phone, $city, $address, $order_date);
    if(!$stmt->execute()){
        header("location: index.php");
        exit;
    }

    $order_id = $stmt -> insert_id;
    //get all products from cart and insert them into database

    foreach($_SESSION['cart'] as $id=>$product){
        $product = $_SESSION['cart'][$id];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];

        $stmt1 = $conn->prepare("INSERT INTO order_items(order_id, product_id, product_name, product_image, product_price, product_quantity, user_name, order_date)
                values(?,?,?,?,?,?,?,?)");
        $stmt1 -> bind_param("iisssiss",$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$name,$order_date);
        $stmt1->execute();
    }

    //store order id in session
    $_SESSION['order_id'] = $order_id;

    //take user to payment page
    header("location: payment.php");
}
?>