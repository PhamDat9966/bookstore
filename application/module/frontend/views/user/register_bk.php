<?php 

    $dataForm   = @$this->arrParam['form'];
    $typeSave      = Helper::cmsInput($type='hidden', $name='type', $value='save', $id='');
    
    // FORM INPUT
    $inputUserName = Helper::cmsInput($type = 'text', $name = 'form[username]' , $value = @$dataForm['username'], $id = 'username', $class = 'form-control');
    $inputFullName = Helper::cmsInput($type = 'text', $name = 'form[fullname]' , $value = @$dataForm['fullname'], $id = 'fullname', $class = 'form-control');
    $inputEmail    = Helper::cmsInput($type = 'text', $name = 'form[email]'    , $value = @$dataForm['email'],    $id = 'email'   , $class = 'form-control');
    $inputPassword = Helper::cmsInput($type = 'text', $name = 'form[password]' , $value = @$dataForm['password'], $id = 'password', $class = 'form-control');
    
    $rowUserName   = Helper::cmsRow($lblName = 'Tên Tài Khoảng' , $input = $inputUserName , $option = 'for="username"'  );
    $rowFullName   = Helper::cmsRow($lblName = 'Họ Và Tên'      , $input = $inputFullName , $option = 'for="fullname"'  );
    $rowEmail      = Helper::cmsRow($lblName = 'Email'          , $input = $inputEmail    , $option = 'for="email"'     );
    $rowPassword   = Helper::cmsRow($lblName = 'Mật Khẩu'       , $input = $inputPassword , $option = 'for="password"'  );
    
    // SUBMIT BUTTON
    $buttonSumit   = Helper::cmsButtonSubmitPUBLIC($type = 'submit', $class = 'btn btn-solid' , $textOutfit = 'Tạo tài khoản' ,$name = "form[submit]" , $value = 'Tạo tài khoảng', $id = 'submit');
    $inputToken    = Helper::cmsInput($type = 'hidden', $name = '[form]token', $value = time(), $id = 'token');
    
    $registerLink  = URL::createLink($module = 'frontend', $controller = 'index', $action = 'register');

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
							<?php echo $rowUserName . $rowFullName . $rowEmail . $rowPassword;?>
						</div>
						<input type="hidden" id="form[token]" name="form[token]"
							value="<?php echo time();?>">
						<?php echo $buttonSumit;?>
					</form>
					<!-- form end -->
				</div>
			</div>
		</div>
	</div>
</section>