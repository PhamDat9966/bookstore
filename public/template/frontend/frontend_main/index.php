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
    <link rel="icon" href="images/favicon.png" type="<?php echo $imageURL;?>/x-icon">
    <link rel="shortcut icon" href="images/favicon.png" type="<?php echo $imageURL;?>/x-icon">
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
    <!-- Content -->
	<?php 
	   include_once MODULE_PATH . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
	?>
	<!-- phonering -->
	<?php 
	   include_once 'html/phonering.php';
	?>
	<!-- end phonering -->
	
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
    <!-- script -->
    <?php
        include_once 'html/script.php';
    ?>
    <!-- end script -->
</body>

</html>