<?php 
    $logoLink = URL::createLink('frontend', 'index', 'index');    

    $imageURL   = $this->_urlImg;
    
    //Link
    
	$linkHome			      = URL::createLink('frontend','index','index', null , null , null ,'home.html');
	$linkBook			      = URL::createLink('frontend','book','list', null, null , null , 'book.html');
	$linkCatalory		      = URL::createLink('frontend','category','index', null, null, null, 'category.html');
	$linkAdminControlPanel	  = URL::createLink('backend','index','index');
	
	$userObj   = Session::get('user');
	
	// Đây là mảng chứa menu navigation
	$arrayMenu     = array();
	$arrayMenu[]   = array('class'=>'index-index','link'=>$linkHome,'name'=>'Trang chủ');
	$arrayMenu[]   = array('class'=>'book-list', 'link'=>$linkBook,'name'=>'Sách');	
	/* Tại Category có nhánh con*/
	$arrayMenu['category']   = array('class'=>'category-index','link'=>$linkCatalory,'name'=>'Danh mục',
                            	    'child-list'=>array(
//                             	        array('id'=>21,'class'=>'','link'=>'abc.html','name'=>'Bà mẹ - Em bé'),
//                             	        array('id'=>22,'class'=>'','link'=>'def.html','name'=>'Chính Trị - Pháp Lý'),
//                             	        array('id'=>23,'class'=>'','link'=>'list.html','name'=>'Học Ngoại Ngữ'),
//                             	        array('id'=>24,'class'=>'','link'=>'list.html','name'=>'Công Nghệ Thông Tin'),
//                             	        array('id'=>25'class'=>'','link'=>'list.html','name'=>'Giáo Khoa - Giáo Trình'),
                            	    )
	                           );
	
	
	// ghi category list tu modul vao  Navigation's Menu
	$modul          = new Model();
	$query          = 'SELECT `id`,`name` FROM `category` WHERE `status`= 1 ORDER BY `ordering` ASC';
	$listCategory   = $modul->fetchPairs($query);
	$this->category_menu = $listCategory;

	$category_child_list = array();
	foreach ($listCategory as $keyCats=>$valueCats){
	    $category_child_list['id']     = $keyCats;        
	    $category_child_list['class']  = 'category-index'.'-'.$keyCats;
	    $category_child_list['link']   = URL::createLink('frontend', 'book', 'list', array('category_id'=>$keyCats));
	    $category_child_list['name']   = $valueCats;
	    
	    // Gán danh sách các chuyên mục category vào arrayMenu 
	    $arrayMenu['category']['child-list'][] = $category_child_list;
	    
	}
	
	if(@$userObj['group_acp'] == TRUE){
	    $arrayMenu[]   = array('class'=>'','link'=>$linkAdminControlPanel,'name'=>'Admin Control Panel');
	}

	/*Xuất menu*/
    $xhtml = '<ul id="main-menu" class="sm pixelstrap sm-horizontal">
				<li>
					<div class="mobile-back text-right">
						Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i>
					</div>
				</li>';  
    
    $activeControl = $this->arrParam['controller'].'-'.$this->arrParam['action'];
    $activeClass   = ''; 
    
	foreach ($arrayMenu as $key=>$value){

        if($activeControl == $value['class']){
            $activeClass = 'my-menu-link active'; // Active
        }else {
            $activeClass = 'temp-not-active';
        }
        
        $category_child_activeClass = '';
        $childClass           = '';
	    if(isset($value['child-list'])){ 
	        
	        if(isset($this->arrParam['category_id'])){
    	        $childClass  = 'category-index-' . $this->arrParam['category_id'];
    	        $childClass  = preg_replace('/\s+/', '', $childClass);
	        }
	        
	        $xhtml .='<li class="'.$value['class'].'"><a href="'.$value['link'].'" class="'.$activeClass.'">'.$value['name'].'</a>';
	           $xhtml .='<ul>';
    	       foreach ($value['child-list'] as $keyC=>$valueC){
    	           
                   $idC         = $valueC['id'];
                   $nameC       = $valueC['name'];
                   $nameCURL    = URL::filterURL($nameC);
                   $linkC       = URL::createLink('frontend', 'book', 'list',array('category_id'=>$idC), null, null,"$nameCURL-$idC.html");
                   
                   $valueChildClass     = preg_replace('/\s+/', '', $valueC['class']);
                   
                   if($childClass == $valueChildClass){
    	               $category_child_activeClass = 'my-menu-link active';
    	           }else{
    	               $category_child_activeClass = 'temp-not-active';
    	           }
    	           
    	           $xhtml .= '<li class="'.$valueC['class'].'">
                                <a href="'.$linkC.'" class="'.$category_child_activeClass.'">
                                    '.$valueC['name'].'
                                </a>
                            </li>';
    	       }
	           $xhtml .='</ul>';
	       $xhtml .='</li>';
	    }else{
	       $xhtml .='<li class="'.$value['class'].'"><a href="'.$value['link'].'" class="'.$activeClass.'">'.$value['name'].'</a></li>';
	    }   
	    
	}
	
	$xhtml .= '</ul>';
	
	// login FALSE
	$linkRegister		      = URL::createLink('frontend','index','register', null,null,null,'register.html');
	$linkLogin			      = URL::createLink('frontend','index','login', null,null,null,'login.html');
	
	// Login TRUE
	$linkLogout		          = URL::createLink('frontend','index','logout');
	$linkUserInfo			  = URL::createLink('frontend','user','profile', null,null,null,'my-account.html');
	
	$arrayAccount         = array();  
	
	if(@$userObj['login'] == FALSE){
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
    
?>

<header class="my-header sticky">
	<div class="mobile-fix-option"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="main-menu">
					<div class="menu-left">
						<div class="brand-logo">
							<a href="<?php echo $logoLink;?>">
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
										<?php 
										  require_once BLOCK_PATH . 'search.php';
										?>
									</li>
									<?php 
									   require_once BLOCK_PATH.'cart.php';
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>