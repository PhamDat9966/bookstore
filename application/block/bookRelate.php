<?php

$bookIdRelate   = $this->Book['id'];
$categoryID =  $this->Book['category_id'];
require_once LIBRARY_PATH . 'Model.php';
$modelRelate        = new Model();
$queryContent       = [];
$queryContent[]     = "SELECT `id`,`name`,`picture`,`price`,`sale_off`";
$queryContent[]     = "FROM `".TBL_BOOK."`";
$queryContent[]     = "WHERE `status` = 1 AND `category_id` = '".$categoryID."' AND `id` !='".$bookIdRelate."'";
$queryContent[]     = 'ORDER BY `ordering` ASC';
$queryContent[]     = 'LIMIT 0,6';

$queryContent       = implode(" ", $queryContent);
$resulfRelate       = $modelRelate->fetchAll($queryContent);

$xhtmlRelate = '';

foreach ($resulfRelate as $keyRel=>$valueRel){
    $id         = $valueRel['id'];
    $name       = $valueRel['name'];
    $url        = URL::createLink('frontend', 'book', 'detail',array('book_id'=>$id));
    
    $picture            = UPLOAD_URL .'book' . DS . $valueRel['picture'];
    $strSpecial1        = '\\';
    $strSpecial2        = "/";
    $picture            = str_replace($strSpecial1 ,$strSpecial2, $picture);
    
    $sale_off           = $valueRel['sale_off'];
    $price              = $valueRel['price'];
    $priceReal          = 0;
    if($valueRel['sale_off'] > 0){
        $priceReal           = number_format($price * (100 - $valueRel['sale_off']) / 100);;
    } else{
        $priceReal         = number_format($price);
    }
    
    
    $xhtmlRelate .= '<div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="lable-block">
                                    <span class="lable4 badge badge-danger"> -'.$sale_off.'%</span>
                                </div>
                                <div class="front">
                                    <a href="'.$url.'">
                                        <img src="'.$picture.'" class="img-fluid blur-up lazyload bg-img" alt="">
                                    </a>
                                </div>
                                <div class="cart-info cart-wrap">
                                    <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                                    <a href="#" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>
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
                                <a href="'.$url.'"
                                    title="'.$name.'">
                                    <h6>'.$name.'</h6>
                                </a>
                                <h4 class="text-lowercase">'.$priceReal.' đ<del>'.$price.' đ</del></h4>
                            </div>
                        </div>
        
                    </div>';
}

?>
<section class="section-b-space j-box ratio_asos pb-0">
    <div class="container">
        <div class="row">
            <div class="col-12 product-related">
                <h2>Sản phẩm liên quan</h2>
            </div>
        </div>
        <div class="row search-product">
            
            <?php echo $xhtmlRelate;?>
           
        </div>
    </div>
</section>
