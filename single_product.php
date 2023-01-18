<?php
    
    include('connection.php');
if(isset($_GET['id'])){
    
    $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $products = $stmt->get_result(); // vector cu un singur obiect 


}
else
    header('location: index.php')


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>RÂȘNIȚA KAFFEE</title>
    

    <!-- Favicon -->
    <link href="assets/img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
   <!--  <link href="assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/style.min.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="index.html" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">RÂȘNIȚA KAFFEE</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="index.html" class="nav-item nav-link active">Acasă</a>
                    <a href="about.html" class="nav-item nav-link">Despre</a>
                    <a href="products.html" class="nav-item nav-link">Meniu</a>
     
                    <a href="cart.html" class="nav-item nav-link">Coș de Cumpăraturi</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Meniu</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Acasă</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Meniu</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Menu Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Meniu & Prețuri</h4>
                <h1 class="display-4">Gustări Delicioase</h1>
            </div>
            <div class="row">
            <?php foreach($products as $product){ ?>            
                <div class="col-lg-12">                  
                    <div class="row align-items-center mb-5 text-center">
                        <div class="col-12 col-sm-12">
                            <img style="width:200px; height: 200px" class="rounded-circle mb-3 mb-sm-0" src="<?php echo 'assets/img/'.$product['product_image']; ?>" alt="">
                            <h5 class="menu-price" style="font-size: 20px"><?php echo $product['product_price'];?> EUR</h5>
                        </div>
                        <div class="col-12 col-sm-12 mt-5">
                            <h4><?php echo $product['product_name']; ?></h4>
                            <p class="m-0"> <?php echo $product['product_description']; ?></p>
                        </div>
                        <form class="mx-auto mt-3" method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $product['product_name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>">
                            <input type="hidden" name="product_special_offer" value="<?php echo $product['product_special_offer']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $product['product_image']; ?>">
                            <input type="hidden" name="product_quantity" value="1">
                            <input type="submit" value="Adaugă în coș" name="add_to_cart" class="btn btn-warning">
                        </form>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Menu End -->




    <!-- Footer Start -->
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-4 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Contact</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Str. Mureșenilor, Nr. 7, Brașov, România</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+040 345 67890</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>rasnita@yahoo.com</p>
            </div>
            <div class="col-lg-5 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Urmărește-ne pe Social Media</h4>
                
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
            <p class="mb-2 text-white">Copyright &copy; <a class="font-weight-bold" href="#">Alice Păzitor</a>. All Rights Reserved.</a></p>
            
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