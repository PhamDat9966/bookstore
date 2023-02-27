<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
	   include_once 'html/header.php';
	?>  
</head>
<body class="hold-transition login-page">
	<?php 
		include_once MODULE_PATH . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
	?>
<!-- jQuery -->
<!-- SCRIPT -->
	<?php include_once 'html/script.php';?>
<!-- END SCRIPT -->
</body>
</html>
