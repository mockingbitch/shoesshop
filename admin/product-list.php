<?php include 'include/header.php'; ?>
<?php
include '../classes/product.php';
$product = new product();
if ($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['delete_id'])){
    $delete_id = $_GET['delete_id'];
    $deleteProduct = $product->delete_product($delete_id);
}
?>
<div class="page-header flex-wrap">

    <div class="header-right d-flex flex-wrap mt-md-2 mt-lg-0" >
        <div class="d-flex align-items-center">
        </div>
        <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" >
            <a href="product-add.php" style="color: white">  <i class="mdi mdi-plus-circle"></i>Thêm sản phẩm </a></button>
    </div>
</div>
<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title" style="font-size: 30px; margin: 50px 0 50px 0" align="center"> Danh sách các hãng</h2>
            <p class="card-description"> <?php if (isset($deleteProduct)) echo $deleteProduct; ?>
            </p>
            <div class="table-responsive">

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Hãng</th>
                        <th>Giá sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th style="text-align: center">Sửa</th>
                        <th style="text-align: center">Xoá</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $show_product = $product->show_product();
                    if ($show_product){
                        while ($result = $show_product->fetch_assoc()){
                            ?>
                            <tr class="table-info">
                                <td><?= $result['productId'] ?></td>
                                <td><?= $result['productName'] ?></td>
                                <td><?= $result['brand'] ?></td>
                                <td><?= $result['productPrice'] ?></td>
                                <td><img src="uploads/products/<?= $result['img'] ?>" alt=""></td>
                                <td align="center"><a href="product-edit.php?id=<?= $result['productId'] ?>"><i class="fa fa-edit" style="font-size:24px;color:green"></i></a></td>
                                <td align="center"><a onclick="return confirm('Bạn có chắc muốn xoá mục này?')" href="?delete_id=<?= $result['productId'] ?>"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a></td>
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
