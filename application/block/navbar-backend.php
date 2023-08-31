<?php

$userImage      = '<img src="' . $this->_urlImg . '/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">';
$userImage_01   = '<img src="' . $this->_urlImg . '/user2-160x160.jpg" class="img-circle" alt="User Image">';
$linkLogout     = URL::createLink('backend', 'index', 'logout');
$viewPage       = URL::createLink('frontend', 'index', 'index', null,null,null,'home.html');
$linkMyProfile  = URL::createLink('backend', 'index', 'profile');

$userName       =  $_SESSION['user']['info']['username'];
$fullNameUser   =  $_SESSION['user']['info']['fullname'];

?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item"><a class="nav-link" data-widget="pushmenu"
			href="#" role="button"><i class="fas fa-bars"></i></a></li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">

		<!-- View Site -->
		<li class="nav-item"><a href="<?php echo $viewPage;?>" class="nav-link"> <i
				class="fa fa-eye" aria-hidden="true"></i> <span>View Site</span>
		</a></li>
		<!-- END View Site -->

		<!-- USER MENU -->
		<li class="nav-item dropdown user user-menu"><a href="#"
			class="nav-link dropdown-toggle" data-toggle="dropdown"> 
              	<?php echo $userImage;?>	
			 	<span><?php echo $userName;?></span>
		</a>
			<ul class="dropdown-menu">
				<!-- User image -->
				<li class="user-header bg-light-blue">
					<?php echo $userImage_01;?> 
					<p>
						ZendVN - Web Developer<small><?php echo $fullNameUser;?></small>
					</p>
				</li>
				<!-- Menu Footer-->
				<li class="user-footer"><a href="<?php echo $linkMyProfile;?>" class="btn btn-default btn-flat">Profile</a>
					<a href="<?php echo $linkLogout;?>" class="btn btn-default btn-flat float-right">Sign out</a>
				</li>
			</ul></li>
		<!-- END USER MENU -->
	</ul>
</nav>