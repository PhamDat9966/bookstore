<?php
    //require_once MODULE_PATH . $this->arrParam['module'] . DS . 'view' . DS . $this->arrParam['action'] . DS . 'productSlider.php';
    
//     echo "<pre>";
//     print_r($this);
//     echo "</pre>";

    $strSpecial1       = '\\';
    $strSpecial2       = "/";
    $imageURL          = str_replace($strSpecial1 ,$strSpecial2, $imageURL); 

    
    $xhtmlBookProduct = '';
    foreach ($this->bookProduct as $keyBook=>$valueBook){
        $id               = $valueBook['id'];
        $nameBook         = $valueBook['name'];
        
        $picture          = UPLOAD_URL .'book' . DS . $valueBook['picture'];
        $strSpecial1       = '\\';
        $strSpecial2       = "/";
        $picture          = str_replace($strSpecial1 ,$strSpecial2, $picture); 
        
        $shortDescription = $valueBook['shortDescription'];
        $sale_off         = $valueBook['sale_off'];
        
        $price              = $valueBook['price'];
        $priceNotSaleOFF    = '';
        if($valueBook['sale_off'] > 0){
            $priceNotSaleOFF= '<del>'.number_format($price).' đ</del>';
            $price          = number_format($price * (100 - $valueBook['sale_off']) / 100);
            $price          = $price.' đ ';
        } else{
            $price              = number_format($price);
        }
        
        // Quick View
        $urlQuickView       = URL::createLink('frontend', 'index', 'quickView');
        $arrQuickView       = array(
            'id'=>$id,
            'url'=>$urlQuickView
        );
        
        $jsonQuickView      = json_encode($arrQuickView);
        
        $xhtmlBookProduct .='<div class="product-box">
                                <div class="img-wrapper">
                                    <div class="lable-block">
                                        <span class="lable4 badge badge-danger"> -'.$sale_off.'%</span>
                                    </div>
                                    <div class="front">
                                        <a href="item.html">
                                            <img src="'.$picture.'" class="img-fluid blur-up lazyload bg-img"
                                                alt="product">
                                        </a>
                                    </div>
                                    <div class="cart-info cart-wrap">
                                        <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                                        <a href="#" title="Quick View" id="quickView-'.$id.'" onclick="quickViewFunction('.htmlentities($jsonQuickView).')"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
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
                                    <a href="item.html"
                                        title="'.$shortDescription.'"</h6>
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