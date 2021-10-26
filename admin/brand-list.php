<?php include 'include/header.php'; ?>
<?php
    include '../classes/brand.php';
    $brand = new brand();
    if ($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['delete_id'])){
        $delete_id = $_GET['delete_id'];
        $deleteBrand = $brand->delete_brand($delete_id);
    }
?>
<div class="page-header flex-wrap">

    <div class="header-right d-flex flex-wrap mt-md-2 mt-lg-0" >
        <div class="d-flex align-items-center">

        </div>
        <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" >
            <a href="brand-add.php" style="color: white">  <i class="mdi mdi-plus-circle"></i>Thêm hãng </a></button>
    </div>
</div>
<div class="col-lg-12 stretch-card">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title" style="font-size: 30px; margin: 50px 0 50px 0" align="center"> Danh sách các hãng</h2>
            <p class="card-description"> <?php if (isset($deleteBrand)) echo $deleteBrand; ?>
            </p>
            <div class="table-responsive">

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên hãng</th>
                        <th style="text-align: center">Sửa</th>
                        <th style="text-align: center">Xoá</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $show_brand = $brand->show_brand();
                        if ($show_brand){
                            while ($result = $show_brand->fetch_assoc()){
                    ?>
                    <tr class="table-info">
                        <td><?= $result['brandId'] ?></td>
                        <td><?= $result['brandName'] ?></td>
                        <td align="center"><a href="brand-edit.php?id=<?= $result['brandId'] ?>"><i class="fa fa-edit" style="font-size:24px;color:green"></i></a></td>
                        <td align="center"><a onclick="return confirm('Bạn có chắc muốn xoá mục này?')" href="?delete_id=<?= $result['brandId'] ?>"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a></td>

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
