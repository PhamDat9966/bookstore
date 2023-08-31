<?php
$login   = false;
if(!empty($_SESSION['user']['login'])){
    $login = true;
}

$message = '';
if(isset($this->message)){
    $message = $this->message;
}

$loginLink  = '';
if($login != true){
    $loginLink   =   Helper::cmsButton(URL::createLink('frontend', 'index', 'login',null,null,null,'login.html'), 'btn btn-solid', 'Đăng Nhập');
}
?>

<div class="breadcrumb-section" style="margin-top: 50px;">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-title">
					<h2 class="py-2"><?php echo $message;?></h2>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="p-0">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="error-section">
					<?php echo $loginLink;?>
				</div>
			</div>
		</div>
	</div>
</section>