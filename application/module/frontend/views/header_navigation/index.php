<?php 
    $imageURL   = $this->_urlImg;
    
    //Link
	$linkHome			      = URL::createLink('frontend','index','index');
	$linkBook			      = URL::createLink('frontend','index','list');
	$linkCatalory		      = URL::createLink('frontend','index','category');
	$linkAdminControlPanel	  = URL::createLink('backend','index','index');
	
	$userObj   = Session::get('user');
	
	//$arrayMenu = array(
	//                   array('class'=>'index-index',   'link'=>$linkHome,               'name'=>'Trang chủ'),
	//                   array('class'=>'index-list',    'link'=>$linkBook,               'name'=>'Sách'),
	//                   array('class'=>'',              'link'=>$linkAdminControlPanel,  'name'=>'Admin Control Panel'),
	//                   array('class'=>'index-category','link'=>$linkCatalory,           'name'=>'Danh mục',
	//                         'child-list'=>array(
	//                                               array('class'=>'','link'=>'abc.html','name'=>'Bà mẹ - Em bé'), 
	//                                               array('class'=>'','link'=>'def.html','name'=>'Chính Trị - Pháp Lý'), 
    //                	                           array('class'=>'','link'=>'list.html','name'=>'Học Ngoại Ngữ'),
    //                	                           array('class'=>'','link'=>'list.html','name'=>'Công Nghệ Thông Tin'), 
	//                                               array('class'=>'','link'=>'list.html','name'=>'Giáo Khoa - Giáo Trình'), 
	//                                           ) 
	//                   )
    //             );
	
	// Default
	$arrayMenu     = array();
	$arrayMenu[]   = array('class'=>'index-index','link'=>$linkHome,'name'=>'Trang chủ');
	$arrayMenu[]   = array('class'=>'index-list', 'link'=>$linkBook,'name'=>'Sách');	
	$arrayMenu[]   = array('class'=>'index-category','link'=>$linkCatalory,           'name'=>'Danh mục',
                	    'child-list'=>array(
                	        array('class'=>'','link'=>'abc.html','name'=>'Bà mẹ - Em bé'),
                	        array('class'=>'','link'=>'def.html','name'=>'Chính Trị - Pháp Lý'),
                	        array('class'=>'','link'=>'list.html','name'=>'Học Ngoại Ngữ'),
                	        array('class'=>'','link'=>'list.html','name'=>'Công Nghệ Thông Tin'),
                	        array('class'=>'','link'=>'list.html','name'=>'Giáo Khoa - Giáo Trình'),
                	    )
	);
	
	if($userObj['group_acp'] == TRUE){
	    $arrayMenu[]   = array('class'=>'','link'=>$linkAdminControlPanel,'name'=>'Admin Control Panel');
	}
	
    $xhtml = '<ul id="main-menu" class="sm pixelstrap sm-horizontal">
				<li>
					<div class="mobile-back text-right">
						Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i>
					</div>
				</li>';   
    
	foreach ($arrayMenu as $key=>$value){
	    
	    if(isset($value['child-list'])){
	       $xhtml .='<li class="'.$value['class'].'"><a href="'.$value['link'].'">'.$value['name'].'</a>';
	           $xhtml .='<ul>';
    	       foreach ($value['child-list'] as $keyC=>$valueC){
    	           $xhtml .= '<li class="'.$valueC['class'].'"><a href="'.$valueC['link'].'">'.$valueC['name'].'</a></li>';
    	       }
	           $xhtml .='</ul>';
	       $xhtml .='</li>';
	    }else{
	       $xhtml .='<li class="'.$value['class'].'"><a href="'.$value['link'].'">'.$value['name'].'</a></li>';
	    }   
	    
	}
	
	$xhtml .= '</ul>';
	
	
/*	
	<li class="index-index"><a href="<?php echo $linkHome;?>">Trang chủ</a></li>
	<li class="index-list"><a href="<?php echo $linkBook;?>">Sách</a></li>
	<li class=""><a href="<?php echo $linkAdminControlPanel;?>">Admin Control Panel</a></li>
	<li class="index-category"><a href="<?php echo $linkCatalory;?>">Danh mục</a>
    	<ul>
    	<li><a href="list.html">Bà mẹ - Em bé</a></li>
    	<li><a href="list.html">Chính Trị - Pháp Lý</a></li>
    	<li><a href="list.html">Học Ngoại Ngữ</a></li>
    	<li><a href="list.html">Công Nghệ Thông Tin</a></li>
    	<li><a href="list.html">Giáo Khoa - Giáo Trình</a>
    	
    	</ul>
	</li>
*/	
	
	// login FALSE
	$linkRegister		      = URL::createLink('frontend','index','register');
	$linkLogin			      = URL::createLink('frontend','index','login');
	
	// Login TRUE
	$linkLogout		          = URL::createLink('frontend','index','logout');
	$linkUserInfo			  = URL::createLink('frontend','index','profile');
	
	$arrayAccount         = array();  
	
	if($userObj['login'] == FALSE){
	    $arrayAccount[]   =  array('class'=>'','link'=>$linkLogin,   'name'=>'Đăng nhập');
	    $arrayAccount[]   =  array('class'=>'','link'=>$linkRegister,'name'=>'Đăng ký');
	}else{
	    $arrayAccount[]   =  array('class'=>'','link'=>$linkUserInfo,'name'=>'Tài khoảng');
	    $arrayAccount[]   =  array('class'=>'','link'=>$linkLogout,  'name'=>'Thoát');
	}
	
	$userXhtmlContent    = '<ul class="header-dropdown">
								<li class="onhover-dropdown mobile-account"><img
									src="'.$imageURL.'/avatar.png" alt="avatar">
									<ul class="onhover-show-div">';
    foreach ($arrayAccount as $keyAccount=>$valueAccount){
	   $userXhtmlContent .= '<li><a href="'.$valueAccount['link'].'">'.$valueAccount['name'].'</a></li>';		
    }
    $userXhtmlContent   .= '</ul></li></ul>';
    
	/*
	<ul class="header-dropdown">
		<li class="onhover-dropdown mobile-account"><img
			src="<?php echo $imageURL;?>/avatar.png" alt="avatar">
			<ul class="onhover-show-div">
				<li><a href="<?php echo $linkLogin;?>">Đăng nhập</a></li>
				<li><a href="<?php echo $linkRegister;?>">Đăng ký</a></li>
			</ul></li>
	</ul>
	 */	

?>

<header class="my-header sticky">
	<div class="mobile-fix-option"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="main-menu">
					<div class="menu-left">
						<div class="brand-logo">
							<a href="index.html">
								<h2 class="mb-0" style="color: #5fcbc4">BookStore</h2>
							</a>
						</div>
					</div>
					<div class="menu-right pull-right">
						<div>
							<nav id="main-nav">
								<div class="toggle-nav">
									<i class="fa fa-bars sidebar-bar"></i>
								</div>
								<?php echo $xhtml;?>
							</nav>
						</div>
						<div class="top-header">
							<?php 
							     echo $userXhtmlContent; 
							?>
						</div>
						<div>
							<div class="icon-nav">
								<ul>
									<li class="onhover-div mobile-search">
										<div>
											<img src="<?php echo $imageURL;?>/search.png" onclick="openSearch()"
												class="img-fluid blur-up lazyload" alt=""> <i
												class="ti-search" onclick="openSearch()"></i>
										</div>
										<div id="search-overlay" class="search-overlay">
											<div>
												<span class="closebtn" onclick="closeSearch()"
													title="Close Overlay">×</span>
												<div class="overlay-content">
													<div class="container">
														<div class="row">
															<div class="col-xl-12">
																<form action="" method="GET">
																	<div class="form-group">
																		<input type="text" class="form-control" name="search"
																			id="search-input" placeholder="Tìm kiếm sách...">
																	</div>
																	<button type="submit" class="btn btn-primary">
																		<i class="fa fa-search"></i>
																	</button>
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="onhover-div mobile-cart">
										<div>
											<a href="cart.html" id="cart" class="position-relative"> <img
												src="<?php echo $imageURL;?>/cart.png" class="img-fluid blur-up lazyload"
												alt="cart"> <i class="ti-shopping-cart"></i> <span
												class="badge badge-warning">0</span>
											</a>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>