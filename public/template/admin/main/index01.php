<?php 
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
  
        <div class="content-wrap py-0">
            <div class="section p-0 m-0 h-100 position-absolute"
                style="background: url('public/template/admin/main/images/login-bg.jpg') center center no-repeat; background-size: cover;">   
            </div>
        
            <div class="section bg-transparent min-vh-100 p-0 m-0">
                <div class="vertical-middle">
                    <div class="container-fluid py-5 mx-auto">
                        <div class="center">
                            <h2 class="text-white">ZendVN</h2>
                        </div>
        
                        <div class="card mx-auto rounded-0 border-0"
                            style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
                            <div class="card-body" style="padding: 40px;">
        						
                                <form id="login-form" name="login-form" class="mb-0" action="index.php?module=admin&controller=user&action=login" method="post">
                                    <h3 class="text-center">Đăng Nhập Trang Quản Trị</h3>
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="username">Username:</label>
                                            <input type="text" id="username" name="username" value=""
                                                class="form-control not-dark" required />
                                        </div>
                                    
                                        <div class="col-12 form-group">
                                            <label for="password">Password:</label>
                                            <input type="password" id="password" name="password" value=""
                                                class="form-control not-dark" required />
                                        </div>
                                    
                                        <div class="col-12 form-group">
                                            <input type="submit" name="submit" class="button button-3d button-black m-0" value="Đăng Nhập">
                                            <a href="index.php" class="button button-3d m-0">Quay về</a>
                                        </div>
                                    </div>
                                </form>
        
                            </div>
                        </div>
        
                        <div class="text-center dark mt-3"><small>Copyrights &copy; All Rights Reserved by ZendVN
                                Inc.</small></div>
                    	</div>
                </div>
            </div>
        
        </div>
        
        
	</section><!-- #content end -->

    </div><!-- #wrapper end -->

    <script src="js/jquery.js"></script>
    <script src="js/plugins.min.js"></script>
    <script src="js/functions.js"></script>
</body>

</html>