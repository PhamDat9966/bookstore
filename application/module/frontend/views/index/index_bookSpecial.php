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
        
        $jsonQuickView      = json_encode($arrQuickView);
        $jsonQuickView      = htmlentities($jsonQuickView);
        
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
                                    <a href="'.$urlBookSpecialInfo.'"
                                        title="'.$shortDescription.'"<h6>'.$shortDescription.'</h6>
                                    </a>
                                    <h4 class="text-lowercase">'.$price.' <del>'.$priceNotSaleOFF.'</del></h4>
                                </div>
                            </div>'; 
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