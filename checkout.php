<?php include 'include/header.php'; ?>
<?php
include 'classes/cartcheckout.php';
$cartcheckout = new cartcheckout();
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['checkout'])){
    $checkout = $cartcheckout->addcart($_POST,$_SESSION['cart']);
}
?>
<link rel="stylesheet" href="css/checkout.css">
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <form action="" method="POST">

                <div class="col-md-7">
                    <!-- Billing Details -->
                    <div class="billing-details">
                        <div class="">
                            <h2 class="title">Thông tin </h2>
                        </div>
                        <?php
                        if (isset($checkout)){
                            echo $checkout;
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['customerlogin'])){
                            ?>
                            <div class="form-group">
                                <input class="input" type="text" name="customername" value="<?= $_SESSION['customername'] ?>">
                            </div>
                            <div class="form-group">
                                <input class="input" type="email" name="email" value="<?= $_SESSION['customeremail'] ?>">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="city" placeholder="Tỉnh/Thành phố">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="addressdetail" placeholder="Đường / Xã / Quận">
                            </div>
                            <div class="form-group">
                                <input class="input" type="tel" name="sdt" placeholder="Nhập số điện thoại">
                            </div>
                            <!-- Order notes -->
                            <div class="order-notes">
                                <textarea class="input" name="note" placeholder="Ghi chú"></textarea>
                            </div>
                            <!-- /Order notes -->
                            <?php
                        }
                        else{
                            ?>
                            <h3>Vui lòng <a href="loginuser.php" style=" font-weight: bold">đăng nhập</a> để tiếp tục.</h3>
                            <?php
                        }
                        ?>
                    </div>



                </div>

                <!-- Order Details -->
                <div class="col-md-5 order-details">
                    <div class="">
                        <h2 class="title">Đơn hàng của bạn</h2>
                    </div>
                    <?php
                        if (isset($_SESSION['cart'])){
                            ?>

                    <div class="order-summary">
                        <div class="row">
                            <div class="col-md-6"><strong>Sản phẩm</strong></div>
<!--                            <div class="col-md-6"><strong>Tổng</strong></div>-->
                        </div>

                        <?php $subtotal = 0; ?>
                        <?php if (isset($_SESSION['cart'])){
                            ?>
                        <?php foreach ($_SESSION['cart'] as $key => $value): ?>
                            <div class="order-products">
                                <div class="order-col">
                                    <div><?php echo $value['qty'] ?> x <?php echo $value['name'] ?></div>
                                    <div><?php $total = $value['qty']*$value['price'];
                                        echo number_format($total,0,',','.');
                                        ?> Đ</div>
                                </div>
                            </div>
                            <?php $subtotal+=$total; ?>
                        <?php endforeach; ?>
                        <?php
                        }
                        else{
                            echo '<h4 style="color: red">Giỏ hàng trống, vui lòng thêm sản phẩm để thanh toán</h4>';
                        }
                        ?>
                        <div class="order-col">
                            <div>Shipping</div>
                            <div><strong>FREE</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong style="font-size: 30px">Tổng thanh toán</strong></div>
                            <div><strong style="font-size: 50px;color: red" class="order-total"><?php echo number_format($subtotal,0,',','.');?> Đ</strong></div>
                        </div>
                    </div>


                    <div class="input-checkbox">
                        <input type="checkbox" id="terms">
                        <label for="terms">
                            <span></span>
                            I've read and accept the <a href="#">terms & conditions</a>
                        </label>
                    </div>
                    <input class=" btn primary-btn order-submit" type="submit" name="checkout" value="Xác nhận đơn hàng">
                    <?php
                        }
                        else{
                            echo 'Bạn chưa có sản phẩm trong giỏ hàng';
                        }
                    ?>
                </div>

            </form>
            <!-- /Order Details -->
        </div>
        <!-- /row -->
    </div>

    <!-- /container -->
</div>
<?php include 'include/footer.php'; ?>
