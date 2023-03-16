<?php 

    $dataForm   = @$this->arrParam['form'];
    // FORM ACTION WITH GET
//     $module         = Helper::cmsInput($type='hidden', $name='module', $id='', $value='frontend');
//     $controller     = Helper::cmsInput($type='hidden', $name='controller', $id='', $value='user');
//     $action         = Helper::cmsInput($type='hidden', $name='action', $id='', $value='register');
    $typeSave      = Helper::cmsInput($type='hidden', $name='type', $id='', $value='save');
    
    // FORM INPUT
    $inputUserName = Helper::cmsInput($type = 'text', $name = 'form[username]' , $id = 'username', $value = @$dataForm['username'], $class = 'form-control');
    $inputFullName = Helper::cmsInput($type = 'text', $name = 'form[fullname]' , $id = 'fullname', $value = @$dataForm['fullname'], $class = 'form-control');
    $inputEmail    = Helper::cmsInput($type = 'text', $name = 'form[email]'    , $id = 'email'   , $value = @$dataForm['email'],    $class = 'form-control');
    $inputPassword = Helper::cmsInput($type = 'text', $name = 'form[password]' , $id = 'password', $value = @$dataForm['password'], $class = 'form-control');
    
    $rowUserName   = Helper::cmsRow($lblName = 'Tên Tài Khoảng' , $input = $inputUserName , $option = 'for="username"'  );
    $rowFullName   = Helper::cmsRow($lblName = 'Họ Và Tên'      , $input = $inputFullName , $option = 'for="fullname"'  );
    $rowEmail      = Helper::cmsRow($lblName = 'Email'          , $input = $inputEmail    , $option = 'for="email"'     );
    $rowPassword   = Helper::cmsRow($lblName = 'Mật Khẩu'       , $input = $inputPassword , $option = 'for="password"'  );
    
    // SUBMIT BUTTON
    $buttonSubmit  = Helper::cmsButtonSubmitPUBLIC($type = 'submit', $class = 'btn btn-solid' , $textOutfit = 'Tạo tài khoản' ,$name = "form[submit]" , $value = 'Tạo tài khoảng', $id = 'submit');
    $inputToken    = Helper::cmsInput($type = 'hidden', $name = '[form]token', $id = 'token', $value = time());
    
    $registerLink  = URL::createLink($module = 'frontend', $controller = 'user', $action = 'register');

?>
<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-title">
					<h2 class="py-2">Đăng ký tài khoản</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="register-page section-b-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h3>Đăng ký tài khoản</h3>
				<?php echo @$this->errors;?>
				<div class="theme-card">
					<!-- Form -->
<!-- 					<form action="#" method="get" id="admin-form" class="theme-form"> -->
					<form action="<?php echo $registerLink;?>" method="post" id="admin-form" class="theme-form">
						<div class="form-row">
							<!-- module controller action typeSave -->
							<?php //echo $module . $controller . $action;?>
							<?php echo $typeSave;?>
							<!-- Form Input -->
							<div class="col-md-6">
    							<?php echo $rowUserName;?>
    						</div>
    						<div class="col-md-6">	
    							<?php echo $rowFullName;?>
    						</div>
    						<div class="col-md-6">	
    							<?php echo $rowEmail;?>
    						</div>
    						<div class="col-md-6">	
    							<?php echo $rowPassword;?>
    						</div>	
						</div>
						<?php echo $inputToken;?>
						<?php echo $buttonSubmit;?>
					</form>
					<!-- form end -->
				</div>
			</div>
		</div>
	</div>
</section>