<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Sản phẩm đang nổi</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="nav-main">
                        <!-- Tab Nav -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#man" role="tab">aaa</a></li>

                        </ul>
                        <!--/ End Tab Nav -->
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <!-- Start Single Tab -->
                        <div class="tab-pane fade show active" id="man" role="tabpanel">
                            <div class="tab-single">
                                <div class="row">
                                    <?php
                                        include 'classes/product.php';
                                        $product = new product();
                                        $show_product = $product->show_product();
                                        if ($show_product){
                                            while ($result_sp=$show_product->fetch_assoc()){
                                    ?>
                                    <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="/productdetail.php?id=<?=$result_sp['productId']; ?>">
                                                    <img class="default-img" src="../admin/uploads/products/<?php echo $result_sp['img']; ?>" alt="#">
                                                    <img class="hover-img" src="../admin/uploads/products/<?php echo $result_sp['img']; ?>" alt="#">
                                                </a>
                                                <div class="button-head">
                                                    <div class="product-action">
                                                        <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                                        <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                                        <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
                                                    </div>
                                                    <div class="product-action-2">
                                                        <a title="Add to cart" href="#">Add to cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="/productdetail.php?id=<?php echo $result_sp['productId']; ?>"><?php echo $result_sp['productName']; ?></a></h3>
                                                <div class="product-price">
                                                    <span><?php echo $result_sp['productPrice']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                            }
                                        }
                                        ?>

                                </div>
                            </div>
                        </div>
                        <!--/ End Single Tab -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-area most-popular section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Hot Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    <!-- Start Single Product -->
                    <?php
                    $show_sp = $product->show_product();
                    if ($show_sp){
                    while ($result_sphot=$show_sp->fetch_assoc()){
                    ?>
                    <div class="single-product">
                        <div class="product-img">
                            <a href="/chitietsanpham.php?id=<?= $result_sphot['productId']; ?>">
                                <img class="default-img" src="/admin/uploads/products/<?= $result_sphot['img']; ?>" alt="#">
                                <img class="hover-img" src="/admin/uploads/products/<?= $result_sphot['img']; ?>" alt="#">
                                <span class="out-of-stock">Hot</span>
                            </a>
                            <div class="button-head">
                                <div class="product-action">
                                    <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                    <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                    <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
                                </div>
                                <div class="product-action-2">
                                    <a title="Add to cart" href="#">Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="productdetail.php?id=<?= $result_sphot['productId'] ?>"><?= $result_sphot['productName']; ?></a></h3>
                            <div class="product-price">
                                <span class="old"><?=$result_sphot['productPrice']; ?></span>
                                <span><?=$result_sphot['productPrice']; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    }?>
                    <!-- End Single Product -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Most Popular Area -->
<!-- Start Shop Services Area -->