<?php

    $strSpecial1       = '\\';
    $strSpecial2       = "/";
    $imageURL          = str_replace($strSpecial1 ,$strSpecial2, $imageURL); 
    
    $dataSpecialBookBanner = $this->bookSpecial;
    /*Trộn mảng book Special*/
    require_once LIBRARY_PATH . 'functions.php';
    $dataSpecialBookBanner = mixArray($dataSpecialBookBanner); 
    
    $xhtmlBookProduct = '';
    foreach ($dataSpecialBookBanner as $keyBook=>$valueBook){
        $id               = $valueBook['id'];
        $nameBook         = $valueBook['name'];
        
        $picture          = UPLOAD_URL .'book' . DS . $valueBook['picture'];
        $strSpecial1       = '\\';
        $strSpecial2       = "/";
        $picture          = str_replace($strSpecial1 ,$strSpecial2, $picture); 
        
        $shortDescription =  mb_strimwidth($valueBook['shortDescription'], 0, 100, "...");
        
        $sale_off         = $valueBook['sale_off'];
        
        $price              = $valueBook['price'];
        $priceNotSaleOFF    = '';
        $priceReal          = 0;
        if($valueBook['sale_off'] > 0){
            $priceReal      = $price * (100 - $valueBook['sale_off']) / 100;
            $priceNotSaleOFF= '<del>'.number_format($price).' đ</del>';
            $price          = number_format($price * (100 - $valueBook['sale_off']) / 100);
            $price          = $price.' đ ';
        } else{
            $price              = number_format($price);
            $priceReal      = $price;
        }
        
        $urlBookSpecialInfo = URL::createLink('frontend', 'book', 'detail',array('book_id'=>$id));
        
        /* Ajax Order*/
        $linkOrderSpecial          = URL::createLink('frontend', 'user', 'ajaxOrder',array('book_id'=>$id,'price'=>$priceReal));
        $linkOrderSpecial          = json_encode($linkOrderSpecial);
        $linkOrderJSONSpecial      = htmlentities($linkOrderSpecial);
        
        /* Ajax Order Trường hợp chưa đăng nhập */
        if(!isset($_SESSION['user'])){
            $linkOrderJSONSpecial = Null;
        }
        
        // Quick View
        $urlQuickView       = URL::createLink('frontend', 'book', 'quickView');
        $arrQuickView       = array(
            'book_id'=>$id,
            'url'    =>$urlQuickView
        );
        
        $jsonQuickView          = json_encode($arrQuickView);
        $jsonQuickViewSpecial   = htmlentities($jsonQuickView);
        
        $xhtmlBookProduct .='<div class="product-box">
                                <div class="img-wrapper">
                                    <div class="lable-block">
                                        <span class="lable4 badge badge-danger"> -'.$sale_off.'%</span>
                                    </div>
                                    <div class="front">
                                        <a href="'.$urlBookSpecialInfo.'">
                                            <img src="'.$picture.'" class="img-fluid blur-up lazyload bg-img"
                                                alt="product">
                                        </a>
                                    </div>
                                    <div class="cart-info cart-wrap">
                                        <a href="#" onclick="ajaxOrder(\''.$linkOrderJSONSpecial.'\')" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                                        <a href="#" title="Quick View" id="quickView-'.$id.'" onclick="quickViewFunction('.$jsonQuickViewSpecial.')"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
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
                                    <a href="'.$urlBookSpecialInfo.'"
                                        title="'.$shortDescription.'"<h6>'.$shortDescription.'</h6>
                                    </a>
                                    <h4 class="text-lowercase">'.$price.' <del>'.$priceNotSaleOFF.'</del></h4>
                                </div>
                            </div>'; 
        
        
        // Order Tại QuickView: Thẻ chọn mua
        $linkOrderSPE          = URL::createLink('frontend', 'user', 'ajaxOrder',array('book_id'=>$id,'price'=>$priceReal));
        $linkOrderSPE          = json_encode($linkOrderSPE);
        $linkOrderjsonSPE      = htmlentities($linkOrderSPE);
        
        /* Trường hợp chưa đăng nhập */
        if(!isset($_SESSION['user'])){
            $linkOrderjsonSPE = Null;
        }
        
        $ajaxClickOrderQuickViewSPE     = '<a onclick="ajaxOrderQuickView(\''.$linkOrderjsonSPE.'\')" href="#" class="btn btn-solid mb-1 btn-add-to-cart">Chọn Mua</a>';
        
    }
    
?>
<!-- Title-->
<div class="title1 section-t-space title5">
    <h2 class="title-inner1">Sản phẩm nổi bật</h2>
    <hr role="tournament6">
</div>

<!-- Product slider -->

<section class="section-b-space p-t-0 j-box ratio_asos">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="product-4 product-m no-arrow">
                        <?php 
                            echo $xhtmlBookProduct;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product slider end -->
    
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
                                echo $ajaxClickOrderQuickViewSPE;
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

    