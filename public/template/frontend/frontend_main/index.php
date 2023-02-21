<?php
    $imageURL           = $this->_urlImg;
    $strSpecial1        = '\\';
    $strSpecial2        = "/";
    $imageURL           = str_replace($strSpecial1 ,$strSpecial2, $imageURL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include_once 'html/header.php';
    ?>
</head>

<body>
    <!-- Loader skeleton -->
	<?php
		include_once 'html/loader_skeleton.php';
	?>
	<!-- end Loader skeleton -->

    <!-- header start -->
	<?php
	   include_once MODULE_PATH . $this->_moduleName . DS . 'views' . DS . 'user' . DS .'header_navigation.php';
	?>
    <!-- header end -->

    <!-- Home slider -->
    <?php 
       require_once 'html/home_slider.php';
    ?>
    <!-- Home slider end -->

    <!-- Top Collection -->
        <!-- Title-->
        <div class="title1 section-t-space title5">
            <h2 class="title-inner1">Sản phẩm nổi bật</h2>
            <hr role="tournament6">
        </div>
        <!-- Product slider -->
        <?php
            require_once 'html/productSlider.php';
        ?>    
        <!-- Product slider end -->
    <!-- Top Collection end-->

    <!-- service layout -->
    <?php
        //Giao Hàng Miễn Phí 
        //Hỗ Trợ 24/7
        //Ưu Đãi và Khuyễn Mãi    
        include_once 'html/serviceLayout.php';
    ?>
    <!-- service layout  end -->

    <!-- Tab product -->
    <?php
        //Danh Mục Nổi Bật 
        include_once 'html/product.php';
    ?>        
    <!-- Tab product end -->

    <!-- Quick-view modal popup start-->
    <div class="modal fade bd-example-modal-lg theme-modal" id="quick-view" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content quick-view-modal">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span></button>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="quick-view-img"><img src="<?php echo $this->_urlImg;?>/quick-view-bg.jpg" alt=""
                                    class="w-100 img-fluid blur-up lazyload book-picture"></div>
                        </div>
                        <div class="col-lg-6 rtl-text">
                            <div class="product-right">
                                <h2 class="book-name">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores,
                                    distinctio.</h2>
                                <h3 class="book-price">26.910 ₫ <del>39.000 ₫</del></h3>
                                <div class="border-product">
                                    <div class="book-description">Lorem ipsum dolor sit amet consectetur, adipisicing
                                        elit. Unde quae cupiditate delectus laudantium odio molestiae deleniti facilis
                                        itaque ut vero architecto nulla officiis in nam qui, doloremque iste. Incidunt,
                                        in?</div>
                                </div>
                                <div class="product-description border-product">
                                    <h6 class="product-title">Số lượng</h6>
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-left-minus" data-type="minus"
                                                    data-field="">
                                                    <i class="ti-angle-left"></i>
                                                </button>
                                            </span>
                                            <input type="text" name="quantity" class="form-control input-number"
                                                value="1">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-right-plus" data-type="plus"
                                                    data-field="">
                                                    <i class="ti-angle-right"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-buttons">
                                    <a href="#" class="btn btn-solid mb-1 btn-add-to-cart">Chọn Mua</a>
                                    <a href="item.html" class="btn btn-solid mb-1 btn-view-book-detail">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- Quick-view modal popup end-->

    <!-- footer -->
        <?php
            include_once 'html/footer.php';
        ?>
    <!-- footer end -->

    <!-- tap to top -->
    <div class="tap-top top-cls">
        <div>
            <i class="fa fa-angle-double-up"></i>
        </div>
    </div>
    <!-- tap to top end -->
    <!-- script -->
        <?php
            include_once 'html/script.php';
        ?>
    <!-- end script -->
</body>

</html>