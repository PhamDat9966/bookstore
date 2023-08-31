<?php 

$activeQuickViewModal   = '';
if(isset($_SESSION['user'])){
    if($_SESSION['user']['login'] == 1){
        $activeQuickViewModal = 'data-toggle="modal" data-target="#quick-view"';
    }
}

/* Danh Mục Nổi Bật */
$arrCategoryList = $this->categoryShowHome;

$xhmlCategoryList = '';
$first_key_Category = '';
if(reset($arrCategoryList)){
    $first_key_Category = key($arrCategoryList);
}
/* Tag Category*/
foreach ($arrCategoryList as $keyCat=>$valueCat){
    if($keyCat == $first_key_Category){
        $xhmlCategoryList .= '<li class="current">
                                <a href="tab-category-'.$keyCat.'" class="my-product-tab" data-category="'.$keyCat.'">'.$valueCat.'</a>
                            </li>';
    }else {
        $xhmlCategoryList .= '<li>
                                <a href="tab-category-'.$keyCat.'" class="my-product-tab" data-category="'.$keyCat.'">'.$valueCat.'</a>
                            </li>';
    }    
}
/* Book on Tag */
$xhtmlCategoryInfo ='<div class="tab-content-cls">';

foreach ($arrCategoryList as $keyCatList=>$valueCatList){
    $classActive = '';
    if($first_key_Category == $keyCatList){
        $classActive = 'active default';
    }
    /* Tag Content */
    $xhtmlCategoryInfo .='<div id="tab-category-'.$keyCatList.'" class="tab-content '.$classActive.'">';
    $xhtmlCategoryInfo .=   '<div class="no-slider row tab-content-inside">';
    foreach ($this->bookCategoryProduct as $keyBookInCat=>$valueBookInCat){
        $id                 = $valueBookInCat['id'];  
        $nameBook           = $valueBookInCat['name'];
        
        $bookNameURL        = Helper::replaceSpecialChar($valueBookInCat['name']); 
        $bookNameURL        = Helper::replaceNumberChar($bookNameURL);
        $bookNameURL        = URL::filterURL($bookNameURL);
        $catNameURL         = URL::filterURL($valueBookInCat['category_name']);
        
        $catID      = $valueBookInCat['category_id'];
        
        $urlBookProductInfo = URL::createLink('frontend', 'book', 'detail',array('book_id'=>$id), null, null,"$catNameURL/$bookNameURL-$catID-$id.html");

        //PICTURE
        $pictureURL         = Helper::createImageURL('book', $valueBookInCat['picture']);
        $picture            = Helper::createImageShort('book', $valueBookInCat['picture'],array('class'=>'img-fluid blur-up lazyload bg-img'),array('display'=>'none'));
        
        $attrAtagBookPic    = array('class'=>'bg-size blur-up lazyloaded');
        $styleAtagBookPic   = array(
            'background-image'      =>$pictureURL,
            'background-size'       =>'cover',
            'background-position'   =>' center center',
            'display'               =>'block'
        );
        $tabIndex               = '-1';
        
        $aTagBookPictureProduct = Helper::createImageATag($urlBookProductInfo,$attrAtagBookPic,$styleAtagBookPic,$picture,$tabIndex,$alt='Product');
        
        $shortDescription = $valueBookInCat['shortDescription'];
        
        $shortDescription =  mb_strimwidth($valueBookInCat['shortDescription'], 0, 100, '...');
        
        $sale_off         = $valueBookInCat['sale_off'];
        
        $price            = $valueBookInCat['price'];
        $priceNotSaleOFF  = '';
        
        if($valueBookInCat['sale_off'] > 0){
            $priceReal      = $price * (100 - $valueBookInCat['sale_off']) / 100;
            $priceNotSaleOFF= '<del>'.number_format($price).' đ</del>';
            $price          = number_format($price * (100 - $valueBookInCat['sale_off']) / 100);
            $price          = $price.' đ ';
        } else{
            $price          = number_format($price);
            $priceReal      = $price;
        }
        
        /* Ajax Order*/
        $linkOrderProduct          = URL::createLink('frontend', 'user', 'ajaxOrder',array('book_id'=>$id,'price'=>$priceReal,'quantity'=>1));
        $linkOrderProduct          = json_encode($linkOrderProduct);
        $linkOrderJSONProduct      = htmlentities($linkOrderProduct);
        
        $session_flag_stop         = FALSE; 
        /* Ajax Order Trường hợp chưa đăng nhập */
        if(!isset($_SESSION['user'])){
            $linkOrderJSONProduct = Null;
            $session_flag_stop    = TRUE; 
        }
        
        // Quick View
        $urlQuickView       = URL::createLink('frontend', 'book', 'quickView');
        $arrQuickView       = array(
            'book_id'=>$id,
            'url'=>$urlQuickView,
            'session_flag_stop'   =>$session_flag_stop
        );
        
        $jsonQuickView      = json_encode($arrQuickView);
        $jsonQuickView      = htmlentities($jsonQuickView);
        
        if($keyCatList == $valueBookInCat['category_id']){
            $xhtmlCategoryInfo .=   '<div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block">
                                                <span class="lable4 badge badge-danger"> -'.$sale_off.'%</span>
                                            </div>
                                            <div class="front">
                                                '.$aTagBookPictureProduct.'
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <a href="#" onclick="ajaxOrder(\''.$linkOrderJSONProduct.'\')" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                                                <a href="#" title="Quick View" id="quickView-'.$id.'" onclick="quickViewFunction('.$jsonQuickView.')"><i class="ti-search" '.$activeQuickViewModal.'></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <a href="'.$urlBookProductInfo.'" title="'.$shortDescription.'"
                                                <h6>'.$shortDescription.'</h6>
                                            </a>
                                            <h4 class="text-lowercase">'.$price.'<del>'.$priceNotSaleOFF.'</del></h4>
                                        </div>
                                    </div>';
        }
    }
    
    $xhtmlCategoryInfo .= '</div>';
    $xhtmlCategoryInfo .='</div>';
   
}
$AllBookList           = URL::createLink('frontend', 'book', 'list');
$xhtmlCategoryInfo .=       '<div class="text-center">
                			<a href="'.$AllBookList.'" class="btn btn-solid">Xem tất cả</a>
                		</div>';
$xhtmlCategoryInfo .= '</div>';

// Order Tại QuickView: Thẻ chọn mua
$linkOrderPRODUCT          = URL::createLink('frontend', 'user', 'ajaxOrder',array('book_id'=>$id,'price'=>$priceReal));
$linkOrderPRODUCT          = json_encode($linkOrderPRODUCT);
$linkOrderjsonPRODUCT       = htmlentities($linkOrderPRODUCT);

/* Trường hợp chưa đăng nhập */
if(!isset($_SESSION['user'])){
    $linkOrderjsonPRODUCT  = Null;
}

//$ajaxClickOrderQuickViewPRODUCT     = '<a onclick="ajaxOrderQuickView(\''.$linkOrderjsonPRODUCT  .'\')" href="#" class="btn btn-solid mb-1 btn-add-to-cart">Chọn Mua</a>';

?>
<div class="title1 section-t-space title5">
    <h2 class="title-inner1">Danh mục nổi bật</h2>
    <hr role="tournament6">
</div>
<section class="p-t-0 j-box ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="theme-tab">
                    <ul class="tabs tab-title">
						<?php 
						      echo $xhmlCategoryList;
						?>
                    </ul>
                    
                    <?php 
                      echo $xhtmlCategoryInfo;
                    ?>
                        
                </div>
            </div>
        </div>
    </div>
</section>


    

