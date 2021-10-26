<?php
include 'include/header.php';
include '../classes/brand.php';
$brand = new brand();
if (isset($_POST['cancel'])){
    echo "<script>window.location='brand-list.php'</script>";
}
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add'])){
    $brandName = $_POST['brandName'];
    $brandDescription = $_POST['brandDescription'];
    $add_brand = $brand->add_brand($brandName,$brandDescription);
}
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title" align="center" style="font-size: 30px;margin: 50px 0 50px 0">Thêm hãng</h2>
            <p class="card-description" style="color: red"><?php if (isset($add_brand)) echo $add_brand; ?></p>
            <form class="forms-sample" method="POST" action="">
                <div class="form-group">
                    <label for="exampleInputName1">Tên hãng</label>
                    <input type="text" name="brandName" class="form-control" id="exampleInputName1" placeholder="Tên hãng ..." />
                </div>

                <div class="form-group">
                    <label for="exampleTextarea1">Mô tả</label>
                    <textarea
                        class="form-control"
                        id="exampleTextarea1"
                        rows="4"
                        name="brandDescription"
                    ></textarea>
                </div>
                <input type="submit" name="add" class="btn btn-primary mr-2" value="Thêm hãng" />
                <input class="btn btn-light" type="submit" name="cancel" value="Huỷ" />
            </form>
        </div>
    </div>
</div>
<?php
include 'include/footer.php'
?>