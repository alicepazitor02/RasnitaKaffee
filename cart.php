<?php

session_start();



if(isset($_POST['add_to_cart'])){
                ///inseamna ca este cel putin un produs in cos
                if(isset($_SESSION['cart'])){ ///

                    $products_array_ids = array_column($_SESSION['cart'],"product_id"); 
                    //verificam daca produsul a fost deja adaugat in cos
                    if(!in_array($_POST['product_id'], $products_array_ids)){
                        $product_id = $_POST['product_id'];

                        $product_array = array(
                                'product_id'=>$product_id,
                                'product_name'=>$_POST['product_name'],
                                'product_price'=>$_POST['product_price'],
                                'product_image'=>$_POST['product_image'],
                                'product_special_offer'=>$_POST['product_special_offer'],
                                'product_quantity'=>$_POST['product_quantity']

                        );

                        $_SESSION['cart'][$product_id] = $product_array;
                        //[ 4 =>[], 22 =>[] ]
                    }
                    else{
                        echo "<script>alert('Produsul a fost deja adaugat in cos')</script>";
                    }
                }
                //Daca clientul adauga primul produs in cos 
                else{
                    
                    $product_id = $_POST['product_id'];

                    $product_array = array(
                            'product_id'=>$product_id,
                            'product_name'=>$_POST['product_name'],
                            'product_price'=>$_POST['product_price'],
                            'product_image'=>$_POST['product_image'],
                            'product_special_offer'=>$_POST['product_special_offer'],
                            'product_quantity'=>$_POST['product_quantity']

                    );
                    $_SESSION['cart'][$product_id] = $product_array;

                }

//se calculeaza totalul din cos

calculateTotalCart();

}
else if(isset($_POST['remove_btn'])){


    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    //se calculeaza totalul din cos
    calculateTotalCart();
}
else if(isset($_POST['decrease_quantity_btn'])){

    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    $product = $_SESSION['cart'][$product_id]; //['product_name' => 'table', 'product_quantity' => 6]
    $product['product_quantity'] = $product_quantity - 1;
//daca cantitatea ajunge sa fie mai mica sau egala cu 0 se va sterge produsul din cos
    if($product['product_quantity'] <= 0){
        $product_id = $_POST['product_id'];
        unset($_SESSION['cart'][$product_id]);
    }
    else{
         $_SESSION['cart'][$product_id] = $product;
    }
        

    //se calculeaza totalul din cos
    calculateTotalCart();

    } 
 else if (isset($_POST['increase_quantity_btn'])){
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    $product = $_SESSION['cart'][$product_id]; //['product_name' => 'table', 'product_quantity' => 6]
    $product['product_quantity'] = $product_quantity + 1;

    if($product['product_quantity'] <= 0){
        $product_id = $_POST['product_id'];
        unset($_SESSION['cart'][$product_id]);
    }
    else{
    $_SESSION['cart'][$product_id] = $product;
        }

    
    //se calculeaza totalul din cos
    calculateTotalCart();

}
else{

}

function calculateTotalCart(){

    $total_price = 0;
    $total_quantity = 0;
    
    foreach($_SESSION['cart'] as $id => $product){
        $product = $_SESSION['cart'][$id];
        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total_price = $total_price + ($price*$quantity);
        $total_quantity = $total_quantity + $quantity;
        
    }
    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
}

?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>R????NI??A KAFFEE</title>
    
    <!-- Favicon -->
    <link href="assets/img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <!-- <link href="assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/style.min.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="index.php" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">R????NI??A KAFFEE</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="index.php" class="nav-item nav-link active">Acas??</a>
                    <a href="about.php" class="nav-item nav-link">Despre</a>
                    <a href="products.php" class="nav-item nav-link">Meniu</a>
     
                    <a href="cart.php" class="nav-item nav-link">Cos De Cumparaturi</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Cos De Cumparaturi</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Acas??</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Cos de Cumparaturi</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="container">
        
             

    <section class="cart container mt-2 my-3 py-5">
        <div class="container mt-2">
            <h4>Co??ul T??u</h4>
        </div>

        <table class="pt-5">
            <tr>
                <th>Produs</th>
                <th>Cantitate</th>
                <th>Subtotal</th>
            </tr>

            <?php if(isset($_SESSION['cart'])){ ?>
            <?php foreach($_SESSION['cart'] as $key => $value){ ?>

         
                    <tr>
                        <td>
                            <div class="product-info">
                                <img style="width: 150px; height:150px" src="<?php echo 'assets/img/'.$value['product_image']; ?>" alt="">
                                <div>
                                    <p><?php echo $value['product_name'];?></p>
                                    <small><span><?php echo $value['product_price'];?> EUR</span></small>
                                    <br>
                                    <form method="POST" action="cart.php"> 
                                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                        <input type="submit" name="remove_btn" class="remove-btn" value="Elimin??">
                                    </form>
                                </div>
                            </div>
                        </td>

                        <td>
                            <form method="POST" action="cart.php">
                                <input type="submit" class="edit-btn" name="decrease_quantity_btn" value="-">
                                <input type="text" readonly name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                <input type="submit" name="increase_quantity_btn" class="edit-btn" value="+">
                            </form>
                        </td>

                        <td>
                            <span class="product-price"><?php echo $value['product_price'] * $value['product_quantity'] ?> EUR</span>
                        </td>
                    </tr>
           <?php } ?>
           <?php } ?>

        </table>


        <div class="cart-total">
            <table>
      
                <tr>
                    <td>Total</td>
                    <?php if(isset($_SESSION['cart'])) { ?>
                    <td><?php echo  $_SESSION['total']." EUR " ?></td>
                    <?php  } ?>
                </tr>
           
            </table>
        </div>
        

        <div class="checkout-container">
       
            <form method = "GET" action="checkout.php" >
                <input type="submit" class="btn checkout-btn" value="Finalizeaz?? ??i Pl??te??te" name="checkout_btn">
            </form>
          
        
        </div>





    </section>

              
            </div>
        </div>
    </div>
    <!-- Cart End -->




    <!-- Footer Start -->
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-4 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Contact</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Strada Mure??enilor Nr. 7, Bra??ov, Rom??nia</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+040 345 67890</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>rasnita@yahoo.com</p>
            </div>
            <div class="col-lg-5 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Urmare??te-ne pe Social Media</h4>
                
                <div class="d-flex justify-content-start">
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Program</h4>
                <div>
                    <h6 class="text-white text-uppercase">Luni - Vineri</h6>
                    <p>8.00 AM - 8.00 PM</p>
                    <h6 class="text-white text-uppercase">Sambata - Duminica</h6>
                    <p>2.00 PM - 8.00 PM</p>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center text-white border-top mt-4 py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
            <p class="mb-2 text-white">Copyright &copy; <a class="font-weight-bold" href="#">Alice Pazitor</a>. All Rights Reserved.</a></p>
            
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>


    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
</body>

</html>