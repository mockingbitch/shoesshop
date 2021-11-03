<?php
include_once 'lib/session.php';
include_once 'classes/brand.php';
//Session::checkSession();
ob_start();
session_start();
?>
<?php
    if ($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['loggingout'])){
        session_destroy();
        header('location: index.php');
       // echo '123';
    }
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Tag  -->
    <title>Laptop Center</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/favicon.png">
    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/niceselect.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="css/flex-slider.min.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl-carousel.css">
    <!-- Slicknav -->
    <link rel="stylesheet" href="css/slicknav.min.css">

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="js">

<!-- Header -->
<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            <li><i class="ti-headphone-alt"></i> +8412345678</li>
                            <li><i class="ti-email"></i> trungnguyen@gmail.com</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-7 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                            <?php if (isset($_SESSION['customerlogin'])){
                                ?>
                                <li><i class="ti-user"></i> <a href="#"><?php echo $_SESSION['customername'] ?></a></li>
                                <li><i class="ti-power-off"></i><a href="?loggingout=true.php">Đăng xuất</a></li>
                            <?php
                            }else{
                                ?>
<!--                                <li><i class="ti-user"></i> <a href="#">Tài khoản</a></li>-->
                                <li><i class="ti-power-off"></i><a href="loginuser.php">Đăng nhập</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="index.php"><img src="images/logo4.jpg" alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option selected="selected">All Category</option>
                                <option>Nike</option>
                                <option>Ananas</option>
                                <option>Adidas</option>
                            </select>
                            <form method="GET">
                                <input name="search" placeholder="Tìm kiếm...." type="search">
                                <button formaction="http://localhost/shoes/search-result.php" class="btnn"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar">
                            <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div>
                        <div class="sinlge-bar">
                            <a href="#" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                        </div>
                        <div class="sinlge-bar shopping cart" id="listcart">
                            <a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count">2</span></a>
                            <!-- Shopping Item -->
                            <div class="shopping-item">
                                <div class="dropdown-cart-header">
                                    <span>2 Items</span>
                                    <a href="#">View Cart</a>
                                </div>
                                <ul class="shopping-list">
                                    <?php if (isset($_SESSION['cart'])) : ?>
                                    <?php $subtotal = 0; ?>
                                    <?php foreach ($_SESSION['cart'] as $key => $value): ?>
                                    <li>
                                        <button class="delete" onclick="removeCart(<?php echo $key; ?>)"><i class="fa fa-close"></i></button>
                                        <a class="cart-img" href="#"><img src="http://localhost/shoes/admin/uploads/products/<?= $value['img'] ?>" alt="#"></a>
                                        <h4><a href="#"><?= $value['name'] ?></a></h4>
                                        <p class="quantity"><?= $value['qty'] ?> x <span class="amount"><?= $value['price'] ?></span></p>
                                    </li>
                                            <?php
                                            $total = $value['qty']*$value['price'];
                                            $subtotal = $subtotal+$total;
                                            ?>
                                        <?php endforeach; ?>
                                    <?php else:?>
                                        <p>Chưa có sản phẩm nào trong giỏ hàng!</p>
                                    <?php endif; ?>
                                </ul>
                                <div class="bottom">
                                    <div class="total">
                                        <span>Total</span>
                                        <span class="total-amount"><?php
                                            if (isset($_SESSION['cart'])){
                                                ?>
                                                <h5>Tổng tiền: <?php echo number_format($subtotal,0,',','.'); ?> Đ</h5>
                                                <?php
                                            }else{
                                                echo '';
                                            }
                                            ?></span>
                                    </div>
                                    <a href="viewcart.php" class="btn animate">Xem giỏ hàng</a>
                                </div>
                            </div>
                            <!--/ End Shopping Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">

                    <div class="col-lg-9 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="active"><a href="index.php">Trang chủ</a></li>
                                            <li><a href="all-product.php">Sản phẩm</a></li>
                                            <li><a href="#">Danh mục<i class="ti-angle-down"></i><span class="new">New</span></a>
                                                <ul class="dropdown">
                                                    <?php
                                                        $brand = new brand();
                                                        $show_brand = $brand->show_brand();
                                                        if ($show_brand){
                                                            while ($result = $show_brand->fetch_assoc()){

                                                    ?>
                                                    <li><a href="product-of-brand.php?brand=<?= $result['brandId'] ?>"><?= $result['brandName'] ?></a></li>
                                                    <?php

                                                            }
                                                        }
                                                    ?>
                                                </ul>
                                            </li>
                                            <li><a href="#">Blog<i class="ti-angle-down"></i></a>
                                                <ul class="dropdown">
                                                    <li><a href="blog-single-sidebar.html">Blog Single Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.html">Liên hệ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>