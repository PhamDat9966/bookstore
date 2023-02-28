<?php 
    $linkAction     = URL::createLink('backend', 'index', 'login');
    $message        = '';
    if(!empty($this->errors)){
        $message    = '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							'.$this->errors.'	
						</div>';
    }
    
?>
<div class="login-box">
	<div class="login-logo">
		<a href="<?php echo $linkAction;?>"><b>Admin</b></a>
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Sign in to start your session</p>
			
			<!-- show Errors -->
			<?php echo $message;?>		
            <!-- end show Errors -->
            
			<form action="<?php echo $linkAction;?>" method="post">
				<div class="input-group mb-3">
					<!-- username -->
					<input name="form[username]" type="text" class="form-control" placeholder="Username">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<!-- password -->
					<input name="form[password]" type="password" class="form-control" placeholder="Password">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				
				<!-- Token -->
				<input name="form[token]" type="hidden" value="<?php echo time();?>" >
				
				<div class="row">
					<!-- /.col -->
					<div class="col-12">
						<button type="submit" class="btn bg-info btn-block">Sign In</button>
					</div>
					<!-- /.col -->
				</div>
			</form>

		</div>
		<!-- /.login-card-body -->
	</div>
</div>
<!-- /.login-box -->