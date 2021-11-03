<?php
include 'include/header.php';
include '../classes/cart.php';
$order = new cart();
if (!isset($_GET['id']) && $_GET['id']==NULL){
    echo "<script>window.location='order-list.php'</script>";
}else
{
    $id = $_GET['id'];
}
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['handle'])){
    $handle_order = $order->set_status($id);
}
?>
    <div class="col-12 grid-margin stretch-card">
        <div class="card row">
            <div class="card-body col-md-7">
                <h2 class="card-title" align="center" style="font-size: 30px;margin: 50px 0 50px 0">Đơn hàng</h2>
                <p class="card-description" style="color: green"><?php if (isset($handle_order)) echo $handle_order; ?></p>
                <?php
                    $order_detail = $order->getOrderById($id);
                    if ($order_detail){
                        while ($result = $order_detail->fetch_assoc()){
                ?>
                <form class="forms-sample" method="POST" action="">
                    <div class="form-group">
                        <label for="exampleInputName1">Tên khách hàng</label>
                        <input type="text" class="form-control" value="<?= $result['customerName']; ?>"  />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Thành phố</label>
                        <input type="text" class="form-control" value="<?= $result['city']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Địa chỉ chi tiết</label>
                        <input type="text" class="form-control" value="<?= $result['address']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Số điện thoại</label>
                        <input type="text"  class="form-control" value="<?= $result['sdt']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Tổng đơn</label>
                        <input type="text"  class="form-control" value="<?= $result['subtotal']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">email</label>
                        <input type="text"  class="form-control" value="<?= $result['email']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Mã đơn hàng</label>
                        <input type="text"  class="form-control" value="<?= $result['code']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Ghi chú</label>
                        <textarea
                            class="form-control"
                            rows="4"
                        ><?= $result['note']; ?></textarea>
                    </div>
                    <input type="submit" name="handle" class="btn btn-primary mr-2" value="Xử lý đơn hàng" />
                    <input class="btn btn-light" type="submit" name="cancel" value="Huỷ" />
                </form>
                            <?php
                        }
                    }
                    ?>
            </div>
            <div class="col-md-5" style="">
                <h2 class="card-title" align="center" style="font-size: 30px;margin: 80px 0 50px 0">Danh sách sản phẩm</h2>
                <?php
                    $product = $order->getProductOrder($id);
                    if ($product){
                        while ($value = $product->fetch_assoc()){
                ?>
                <div class="row" style="margin: 15px">
                        <span style="color: green"><?= $value['productQuantity'] ?></span> X <span style="color: green"><?= $value['productName'] ?></span>
                </div>
                            <?php
                        }
                    }
                            ?>
            </div>
        </div>
    </div>
<?php
include 'include/footer.php'
?>