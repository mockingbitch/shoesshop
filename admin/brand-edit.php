<?php
include 'include/header.php';
include '../classes/brand.php';
$brand = new brand();
if(!isset($_GET['id']) || $_GET['id'] == NULL) {
    echo "<script>window.location='brand-list.php'</script>";
}
if (isset($_POST['cancel'])){
    echo "<script>window.location='brand-list.php'</script>";
}
else{
    $id = $_GET['id'];
}
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add'])){
    $brandName = $_POST['brandName'];
    $brandDescription = $_POST['brandDescription'];
    $update_brand = $brand->update_brand($brandName,$brandDescription,$id);
}
?>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" align="center" style="font-size: 30px;margin: 50px 0 50px 0">Sửa hãng</h2>
                <p class="card-description" style="color: red"><?php if (isset($update_brand)) echo $update_brand; ?></p>
                <form class="forms-sample" method="POST" action="">
                    <?php
                        $show_brand = $brand->getbrandbyId($id);
                        if ($show_brand){
                            while ($result = $show_brand->fetch_assoc()){
                    ?>
                    <div class="form-group">
                        <label for="exampleInputName1">Tên hãng</label>
                        <input type="text" name="brandName" class="form-control" id="exampleInputName1" value="<?= $result['brandName'] ?>" />
                    </div>

                    <div class="form-group">
                        <label for="exampleTextarea1">Mô tả</label>
                        <textarea
                            class="form-control"
                            id="exampleTextarea1"
                            rows="4"
                            name="brandDescription"
                        ><?= $result['brandDescription'] ?></textarea>
                    </div>
                    <?php
                            }
                        }
                        ?>
                    <input type="submit" name="add" class="btn btn-primary mr-2" value="Sửa" />
                    <input class="btn btn-light" type="submit" name="cancel" value="Huỷ" />
                </form>
            </div>
        </div>
    </div>
<?php
include 'include/footer.php'
?>