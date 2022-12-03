<?php 
ob_start();

echo "<pre>";
print_r($this);
echo "</pre>";
?>
<?php 

if(Session::get('loggedIn') == true){
    $name        = strtoupper($_SESSION['name']);
    $login_form  = '<h3>Xin chào: '.$name.'</h3>';
    $login_form .= '<a href="index.php?module=admin&controller=user&action=logout">Đăng xuất</a>';
}

// echo $backgroundImg = $this->_dirImg. DS .'login-bg.jpg';
// echo $backgroundImg = $this->_dirImg. DS .'login-bg.jpg';
?>
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
    <div id="wrapper" class="clearfix">

        <!-- Content
		============================================= -->
  	<section id="content" class="w-100">
    <?php     
        require_once MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
    ?>    
	</section><!-- #content end -->

    </div><!-- #wrapper end -->

    <?php 
        echo $this->_jsFile;
    ?>
</body>

</html>