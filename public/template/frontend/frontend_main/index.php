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
        <?php
            require_once 'html/productSlider.php';
        ?>    
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
    <?php
        include_once 'html/quickView.php';
    ?>    
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