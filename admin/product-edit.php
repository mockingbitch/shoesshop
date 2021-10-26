<?php include 'include/header.php'; ?>
<?php
include '../classes/product.php';
$product = new product();
if(!isset($_GET['id']) || $_GET['id'] == NULL) {
    echo "<script>window.location='product-list.php'</script>";
}
else{
    $id = $_GET['id'];
}
if (isset($_POST['cancel'])){
    echo "<script>window.location='product-list.php'</script>";
}

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add'])){
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];
    $brand = $_POST['brand'];
    $update_product = $product->update_product($id,$productName,$productDescription,$productPrice,$productQuantity,$brand,$_FILES);
}
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title" align="center" style="font-size: 30px;margin: 50px 0 50px 0">Sửa sản phẩm</h2>
            <p class="card-description"><?php if (isset($update_product)) echo $update_product; ?></p>
            <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
                <?php
                    $show_product = $product->getproductbyId($id);
                    if ($show_product){
                        while ($result = $show_product->fetch_assoc()){
                ?>
                <div class="form-group">
                    <label for="exampleInputName1">Tên sản phẩm</label>
                    <input type="text" name="productName" class="form-control" id="exampleInputName1" value="<?= $result['productName'] ?>" />
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Mô tả sản phẩm</label>
                    <textarea
                            class="form-control"
                            id="exampleTextarea1"
                            rows="4"
                            name="productDescription"
                    ><?= $result['productDescription'] ?></textarea>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white">VND</span>
                        </div>
                        <input type="number" name="productPrice" class="form-control" value="<?= $result['productPrice'] ?>" />
                        <div class="input-group-append">
                            <span class="input-group-text">.000</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputCity1">Số lượng sản phẩm</label>
                    <input type="number" name="productQuantity" class="form-control" id="exampleInputCity1" value="<?= $result['productQuantity'] ?>" />
                </div>
                            <img style="margin: 20px;border-radius: 10%" width="200px" src="uploads/products/<?php echo $result['img']; ?>" alt="a">
                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <input type="file" name="img" class="file-upload-default" />
                                <div class="input-group col-xs-12">
                                    <input type="file" name="img" class="form-control file-upload-info" placeholder="Tải ảnh lên" />
                                </div>

                            </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Hãng sản phẩm</label>

                    <select class="form-control form-control-lg" name="brand" id="exampleFormControlSelect1">
                        <?php
                        include '../classes/brand.php';
                        $brand = new brand();
                        $get_brand = $brand->show_brand();
                        if ($get_brand){
                            while ($result = $get_brand->fetch_assoc()){
                                ?>
                                <option value="<?= $result['brandId'] ?>"><?= $result['brandName'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>

                </div>


                <?php
                        }
                    }
                ?>
                <input type="submit" name="add" value="Thêm" class="btn btn-primary mr-2" />
                <input type="submit" class="btn btn-light" name="cancel" value="Huỷ" />
            </form>
        </div>
    </div>
</div>
<?php include 'include/footer.php'; ?>
