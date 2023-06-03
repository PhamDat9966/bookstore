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
        include_once "html/header.php";
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
	   include_once BLOCK_PATH . 'header_navigation.php';
	?>
    <!-- header end -->

    <!-- CATEGORY -->
        <!-- main content -->
        <?php
            include_once MODULE_PATH . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
        ?>
        <!-- main content -->
    <!-- END CATAGORY -->

    <!-- phonering -->
    <?php
        include_once 'html/phonering.php';
    ?>
    <!-- phonering end -->
	
    <!-- footer -->
    <?php
        include_once 'html/footer.php';
    ?>
    <!-- footer end -->

    <!-- tap to top -->
    <?php
        include_once 'html/tap-top.php';
    ?>
    <!-- tap to top end -->

    <?php
        include_once 'html/script.php';
    ?>
</body>

</html>