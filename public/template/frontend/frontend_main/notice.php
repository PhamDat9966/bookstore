<?php 
    $imageURL   = $this->_urlImg;
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
		//include_once 'html/header_navigation.php';
	?>
	
	<!-- Main notice -->
	<?php 
	   include_once MODULE_PATH . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
	?>
	<!-- End Main notice -->

	 <!-- footer -->
	 	<?php include_once 'html/footer.php'; ?>
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