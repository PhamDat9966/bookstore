<?php 

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
        $id               = $valueBookInCat['id'];  
        $nameBook         = $valueBookInCat['name'];
        $picture          = UPLOAD_URL .'book' . DS . $valueBookInCat['picture'];
        $strSpecial1      = '\\';
        $strSpecial2      = "/";
        $picture          = str_replace($strSpecial1 ,$strSpecial2, $picture);
        
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
        
        $urlBookProductInfo = URL::createLink('frontend', 'book', 'detail',array('book_id'=>$id));
        
        // Quick View
        $urlQuickView       = URL::createLink('frontend', 'book', 'quickView');
        $arrQuickView       = array(
            'book_id'=>$id,
            'url'=>$urlQuickView
        );
        
        $jsonQuickView      = json_encode($arrQuickView);
        $jsonQuickView      = htmlentities($jsonQuickView);
        
        /* Ajax Order*/
        $linkOrderProduct          = URL::createLink('frontend', 'user', 'ajaxOrder',array('book_id'=>$id,'price'=>$priceReal));
        $linkOrderProduct          = json_encode($linkOrderProduct);
        $linkOrderJSONProduct      = htmlentities($linkOrderProduct);
        
        /* Ajax Order Trường hợp chưa đăng nhập */
        if(!isset($_SESSION['user'])){
            $linkOrderJSONProduct = Null;
        }
        
        if($keyCatList == $valueBookInCat['category_id']){
            $xhtmlCategoryInfo .=   '<div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="lable-block">
                                                <span class="lable4 badge badge-danger"> -'.$sale_off.'%</span>
                                            </div>
                                            <div class="front">
                                                <a href="'.$urlBookProductInfo.'">
                                                    <img src="'.$picture.'" class="img-fluid blur-up lazyload bg-img" alt="product">
                                                </a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <a href="#" onclick="ajaxOrder(\''.$linkOrderJSONProduct.'\')" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                                                <a href="#" title="Quick View" id="quickView-'.$id.'" onclick="quickViewFunction('.$jsonQuickView.')"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
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

$xhtmlCategoryInfo .=       '<div class="text-center">
                			<a href="list.html" class="btn btn-solid">Xem tất cả</a>
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

$ajaxClickOrderQuickViewPRODUCT     = '<a onclick="ajaxOrderQuickView(\''.$linkOrderjsonPRODUCT  .'\')" href="#" class="btn btn-solid mb-1 btn-add-to-cart">Chọn Mua</a>';

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

<!-- Quick view -->
<div class="modal fade bd-example-modal-lg theme-modal" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content quick-view-modal">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                <div class="row">
                	<!--content quick view -->
                    <div class="col-lg-6 col-xs-12">
                        <div class="quick-view-img"><img id="quick-view-img" src="<?php echo $this->_urlImg; ?>/quick-view-bg.jpg" alt="" class="w-100 img-fluid blur-up lazyload book-picture"></div>
                    </div>
                    <div class="col-lg-6 rtl-text">
                        <div class="product-right" id="quick-view-content">
                            <h2 class="book-name" id="book-name">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores,
                                distinctio.</h2>
                            <h3 class="book-price"><span id="book-price">>26.910 ₫</span> <del id="price-not-off">39.000 ₫</del></h3>
                            <div class="border-product">
                                <div class="book-description" id="book-description">Lorem ipsum dolor sit amet consectetur, adipisicing
                                    elit. Unde quae cupiditate delectus laudantium odio molestiae deleniti facilis
                                    itaque ut vero architecto nulla officiis in nam qui, doloremque iste. Incidunt,
                                    in?</div>
                            </div>
                            <div class="product-description border-product">
                                <h6 class="product-title">Số lượng</h6>
                                <div class="qty-box">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
                                                <i class="ti-angle-left"></i>
                                            </button>
                                        </span>
                                        <input type="text" id="input-quantity" name="quantity" class="form-control input-number" value="1">
                                        <span class="input-group-prepend">
                                            <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="">
                                                <i class="ti-angle-right"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-buttons">
                                <?php 
                                    echo $ajaxClickOrderQuickViewPRODUCT;
                                ?>
                                <a href="item.html" class="btn btn-solid mb-1 btn-view-book-detail">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    <!--end content quick view -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Quick view -->

    

