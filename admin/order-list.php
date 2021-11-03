<?php include 'include/header.php'; ?>
<?php
include '../classes/cart.php';
$order = new cart();
if ($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    $deleteOrder = $order->delete_order($id);
}
?>
<div class="page-header flex-wrap">

    <div class="header-right d-flex flex-wrap mt-md-2 mt-lg-0" >
        <div class="d-flex align-items-center">
        </div>
<!--        <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" >-->
<!--            <a href="product-add.php" style="color: white">  <i class="mdi mdi-plus-circle"></i>Danh </a></button>-->
    </div>
</div>
<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title" style="font-size: 30px; margin: 50px 0 50px 0" align="center"> Danh sách đơn hàng</h2>
            <p class="card-description"> <?php if (isset($deleteOrder)) echo $deleteOrder; ?>
            </p>
            <div class="table-responsive">

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Tên khách hàng</th>
                        <th>Trạng thái</th>
                        <th>Tổng đơn</th>
                        <th style="text-align: center">Xem</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $show_order = $order->show_order();
                    if ($show_order){
                        while ($result = $show_order->fetch_assoc()){
                            ?>
                            <tr class="table-info">
                                <td><?= $result['id'] ?></td>
                                <td><?= $result['customerName'] ?></td>
                                <td><?php if ($result['status']==0){
                                    echo '<span style="color: red">Chưa xử lý</span>';
                                    }else{
                                    echo '<span style="color: green">Đã xử lý</span>';

                                    }?></td>
                                <td><?= $result['subtotal'] ?></td>
                                <td align="center"><a href="order-edit.php?id=<?= $result['id'] ?>"><i class="fa fa-edit" style="font-size:24px;color:green"></i></a></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'include/footer.php'; ?>
