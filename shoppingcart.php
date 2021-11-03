<?php
include_once 'lib/session.php';
ob_start();
session_start();
include_once 'classes/cart.php';
$cart = new cart();
if (isset($_POST['productid'])){
    $addtocart = $cart->add_to_cart($_POST);
}
?>
