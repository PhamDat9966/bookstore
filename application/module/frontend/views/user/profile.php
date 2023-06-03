<?php
    $titleProfile = $this->_title;
    $arrMenu      = array(
                            array('Change Pass' ,'changepass.jpg'   , URL::createLink('frontend', 'user', 'index')),
                            array('View Cart'   ,'cart.jpg'     ,     URL::createLink('frontend', 'user', 'cart')),
                            array('History'     ,'history.jpg'  ,     URL::createLink('frontend', 'user', 'history')),
                            array('Logout'      ,'logout.jpg'   ,     URL::createLink('frontend', 'index', 'logout')),
                        );    
    $xhtmlUser   = '';
    foreach ($arrMenu as $value){
        $textName = $value[0];
        $picture  = UPLOAD_URL . 'user' . DS . $value[1];
        $strSpecial1       = '\\';
        $strSpecial2       = "/";
        $picture          = str_replace($strSpecial1 ,$strSpecial2, $picture); 
        
        $link     = $value[2];
        
        $xhtmlUser .='<div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="'.$link.'" class="bg-size blur-up lazyloaded" style="background-image: url(&quot;/bookstore/public/files/book/t8u20xje.jpg&quot;); background-size: cover; background-position: center center; display: block;">
                                        <img src="'.$picture.'" class="img-fluid blur-up lazyload bg-img" alt="" style="display: none;">
                                    </a>
                                </div>
                            </div>
                            <div class="product-detail">
                                <h4 class="text-center">'.$textName.'</h4>
                            </div>
                        </div>
        
                    </div>';
        
    }
    
?>
<div class="breadcrumb-section" style="margin-top: 50px;">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-title">
					<h2 class="py-2"><?php echo $titleProfile;?></h2>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="p-t-0 j-box ratio_asos">
    <div class="container">
        <div class="row search-product justify-content-md-center">
        
            <?php echo $xhtmlUser;?>
                      
        </div>
    </div>
</section>