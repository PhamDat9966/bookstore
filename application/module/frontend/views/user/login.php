<?php 

    $linkAction     = URL::createLink('frontend', 'user', 'login');
    $showErrors     = '';
    if(!empty(@$this->errors)){
        $showErrors     = '<div class="alert bg-danger alert-dismissible">
                                '.$this->errors.'
                           </div>';  
    }    
?>
<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-title">
					<h2 class="py-2">Đăng nhập</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="login-page section-b-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h3>Đăng nhập</h3>
					<?php
            		   
            		       echo $showErrors;

            		?>
				<div class="theme-card">
					<form action="<?php echo $linkAction;?>" method="post" id="admin-form" class="theme-form">
						<div class="form-group">
							<label for="email" class="required">Email</label> <input
								type="email" id="form[email]" name="form[email]" value=""
								class="form-control">
						</div>

						<div class="form-group">
							<label for="password" class="required">Mật khẩu</label> <input
								type="password" id="form[password]" name="form[password]"
								value="" class="form-control">
						</div>
						<input type="hidden" id="form[token]" name="form[token]"
							value="<?php echo time();?>">
						<button type="submit" id="submit" name="submit" value="Đăng nhập"
							class="btn btn-solid">Đăng nhập</button>
					</form>
				</div>
			</div>
			<div class="col-lg-6 right-login">
				<h3>Khách hàng mới</h3>
				<div class="theme-card authentication-right">
					<h6 class="title-font">Đăng ký tài khoản</h6>
					<p>Sign up for a free account at our store. Registration is quick
						and easy. It allows you to be able to order from our shop. To
						start shopping click register.</p>
					<a href="register.html" class="btn btn-solid">Đăng ký</a>
				</div>
			</div>
		</div>
	</div>
</section>