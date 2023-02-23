<?php 
    // FORM ACTION
    $module     = '<input type="hidden"     name="module"       value="frontend">';
    $controller = '<input type="hidden"     name="controller"   value="user">';
    $action     = '<input type="hidden"     name="action"       value="register">';
    $typeSave   = '<input type="hidden"     name="type"         value="save-close">';
    
    // FORM INPUT
    $inputUserName = Helper::cmsInput($type = 'text', $name = 'form[username]' , $id = 'username', $value = '', $class = 'form-control');
    $inputFullName = Helper::cmsInput($type = 'text', $name = 'form[fullname]' , $id = 'fullname', $value = '', $class = 'form-control');
    $inputEmail    = Helper::cmsInput($type = 'text', $name = 'form[email]'    , $id = 'email'   , $value = '', $class = 'form-control');
    $inputPassword = Helper::cmsInput($type = 'text', $name = 'form[password]' , $id = 'password', $value = '', $class = 'form-control');
    
    $rowUserName   = Helper::cmsRow($lblName = 'Tên Tài Khoảng' , $input = $inputUserName , $option = 'for="username"'  );
    $rowFullName   = Helper::cmsRow($lblName = 'Họ Và Tên'      , $input = $inputFullName , $option = 'for="fullname"'  );
    $rowEmail      = Helper::cmsRow($lblName = 'Email'          , $input = $inputEmail    , $option = 'for="email"'     );
    $rowPassword   = Helper::cmsRow($lblName = 'Mật Khẩu'       , $input = $inputPassword , $option = 'for="password"'  );

    $buttonSumit   = Helper::cmsButtonSubmitPUBLIC($type = 'submit', $class = 'class="btn btn-solid"' , $textOutfit = 'Tạo tài khoản' ,$name = 'name="submit"' , $value = 'value="Tạo tài khoảng"', $id = 'id="submit"');
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
				<div class="theme-card">
					<!-- Form -->
					<form action="#" method="get" id="admin-form" class="theme-form">
						<div class="form-row">
							<!-- module controller action typeSave -->
							<?php echo $module . $controller . $action . $typeSave;?>
							<!-- Form Input -->
							<?php echo $rowUserName . $rowFullName . $rowEmail . $rowPassword;?>
						</div>
						<input type="hidden" id="form[token]" name="form[token]"
							value="1599208957">
						<?php echo $buttonSumit;?>
					</form>
					<!-- form end -->
				</div>
			</div>
		</div>
	</div>
</section>