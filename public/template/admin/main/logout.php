
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

	<?php echo $this->_metaHTTP;?>
	<?php echo $this->_metaName;?>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700&display=swap" rel="stylesheet"
    type="text/css" />
	<meta http-equiv="keywords" content="zend" />
	<?php echo $this->_title;?>
	<?php echo $this->_cssFile;?>
	<?php echo $this->_jsFile;?>

</head>
<body class="stretched">

    <!-- Document Wrapper
	============================================= -->
	<?php 
	   require_once MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
	?>
	
    <!-- #wrapper end -->
	<?php 
        echo $this->_jsFile;
    ?>
</body>

</html>