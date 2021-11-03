<?php
include 'include/header.php';
?>

<div class="shopping-cart section">
    <div class="container">
        <div class="row" id="listproduct">
            <div class="col-12 cartreload" >
                <!-- Shopping Summery -->
                <?php if (isset($_SESSION['cart'])): ?>
                    <?php
                    $subtotal = 0;
                    ?>
                    <table class="table shopping-summery" >
                        <thead>
                        <tr class="main-hading">
                            <th>Ảnh sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th class="text-center">Đơn giá</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Tổng</th>
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($_SESSION['cart'] as $key => $value ) : ?>
                            <tr>
                                <td class="image" data-title="No"><img width="100px" src=" admin/uploads/products/<?php echo $value['img'] ?>" alt="#"></td>
                                <td class="product-des" data-title="Description">
                                    <p class="product-name"><a href="#"><?php echo $value['name'] ?></a></p>

                                </td>
                                <td align="center" class="price" data-title="Price"><span><?php echo number_format($value['price'],0,',','.');?> Đ </span></td>
                                <td class="qty" data-title="Qty" align="center"><!-- Input Order -->
                                    <div class="input-group sm">
                                        <input onchange="updateCart(<?php echo $key; ?>)" id="qty_<?php echo $key; ?>" type="number" name="quant[1]" class="input-number sm"    min="1" value="<?php echo $value['qty']; ?>">
                                    </div>
                                    <!--/ End Input Order -->
                                </td>
                                <td align="center" class="total-amount" data-title="Total"><span>
                                <?php
                                $total = $value['qty']*$value['price'];
                                echo number_format($total,0,',','.');
                                ?> Đ</span></td>
                                <td align="center" class="action" data-title="Remove"><button onclick="removeCart(<?php echo $key;  ?>)"><i class="ti-trash remove-icon"></i></button></td>
                            </tr>
                            <?php $subtotal+= $total; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Không tồn tại giỏ hàng!!</p>
                <?php endif; ?>
                <!--/ End Shopping Summery -->
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <!-- Total Amount -->
                <div class="total-amount">
                    <div class="row total">
                        <div class="col-lg-8 col-md-5 col-12">
                            <div class="left">
                                <div class="coupon">
                                    <form action="#" target="_blank">
                                        <input name="Coupon" placeholder="Enter Your Coupon">
                                        <button class="btn">Apply</button>
                                    </form>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox"> Shipping (+10$)</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-7 col-12">
                            <div class="right">
                                <?php if(isset($_SESSION['cart'])){
                                    ?>
                                <ul>
                                    <li><h3>Thành tiền: <span ><?php echo number_format($subtotal,0,',','.');?> Đ</span></h3></li>
                                    <li>Vận chuyển<span>Free</span></li>
                                    <!--                                    <li>You Save<span>$20.00</span></li>-->
                                    <li class="last">Tổng <span><?php echo $subtotal ?></span></li>
                                </ul>
                                <div class="button5">
                                    <a href="checkout.php" class="btn"><h4>Thanh toán</h4></a>
                                    <a href="index.php" class="btn"><h4>Tiếp tục mua hàng</h4></a>
                                </div>
                                <?php
                                }else{
                                    echo 'Vui lòng thêm sản phẩm vào giỏ hàng';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Total Amount -->
            </div>
        </div>
    </div>
</div>
<script>
    function updateCart(id){
        num = $("#qty_"+id).val();
        $.post('updatecart.php',{'id':id,'num':num},function(data){
            $("#listcart").load("http://localhost/shoes/viewcart.php .cart");
            $("#listproduct").load("http://localhost/shoes/viewcart.php .cartreload");
            $(".total-amount").load("http://localhost/shoes/viewcart.php .total");
        });
    }
    function removeCart(id){
        $.post('updatecart.php',{'id':id,'num':0},function(data){
            $(".total-amount").load("http://localhost/shoes/viewcart.php .total");
        });
    }
</script>
<?php
include 'include/footer.php';
?>
