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
	   //include_once MODULE_PATH . $this->_moduleName . DS . 'views' . DS . 'header_navigation' . DS .'index.php';
	   include_once BLOCK_PATH . 'header_navigation.php';
	?>
    <!-- header end -->

	<!-- MAIN CONTENT  --> 
	<?php
	   include_once MODULE_PATH . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
	?>
	<!-- END MAIN CONTENT  -->
    <?php 
        include_once 'html/phonering.php';
    ?>

    <!-- footer -->
    <?php
        include_once 'html/footer.php';
    ?>
    <!-- footer end -->

    <!-- tap to top -->
    <?php 
        include_once 'html/tap_top.php';
    ?>
    <!-- tap to top end -->
    <!-- script -->
    <?php
        include_once 'html/script.php';
    ?>
    <!-- end script -->
</body>

</html>