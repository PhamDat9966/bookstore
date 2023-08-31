<?php

$bookInfo   = $this->Book;

$title_page = $bookInfo['name'];
$name       = $bookInfo['name'];

$picture       = Helper::createImageShort('book', $bookInfo['picture'],array('class'=>'img-fluid w-100 blur-up lazyload image_zoom_cls-0')); 

$sale_book_Off    = '';
if($bookInfo['sale_off']>0){
    $sale_book_Off = '-'.$bookInfo['sale_off'].'%';
}

$priceReal          = 0;
$price              = '';

if($bookInfo['sale_off'] > 0){
    $priceReal          = $bookInfo['price'] * (100 - $bookInfo['sale_off']) / 100;
    $priceNotSaleOFF    = $bookInfo['price'];
    $price             .= '<h4><del>'.number_format($priceNotSaleOFF).' đ</del><span> '.$sale_book_Off.'</span></h4>';
    $price             .= '<h3>'.number_format($priceReal).' đ </h3>';
    
} else{
    $priceReal       = $bookInfo['price'];
    $price          .= '<h3>'.number_format($priceReal).' đ</h3>';
}

$shortDescription   = $bookInfo['shortDescription'];
$description        = $bookInfo['description'];

$linkOrder          = URL::createLink('frontend', 'user', 'ajaxOrder',array('book_id'=>$bookInfo['id'],'price'=>$priceReal));
$linkOrder          = json_encode($linkOrder);
$linkOrderJSON      = htmlentities($linkOrder);

/* Trường hợp chưa đăng nhập */
if(!isset($_SESSION['user'])){
    $linkOrderJSON = Null;
}

$ajaxClickOrder     = '<a id="" href="#" onclick="ajaxOrder(\''.$linkOrderJSON.'\')" class="btn btn-solid ml-0" data-toggle="modal" data-target="#quick-view-complete-order">
                            <i class="fa fa-cart-plus"></i> Chọn mua</a>';

require_once 'quickViewWhenCompleteOrder.php';
?>

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2"><?php echo $title_page;?></h2>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="section-b-space">
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-sm-12 col-xs-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="filter-main-btn mb-2"><span class="filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> filter</span></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="product-slick">
                                    <div>
                                    	<?php echo $picture;?>
                                     </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-xl-8 rtl-text">
                                <div class="product-right">
                                    <h2 class="mb-2"><?php echo $name;?></h2>
									<?php
									   echo $price;
									?>
                                    <div class="product-description border-product">
                                        <h6 class="product-title">Số lượng</h6>
                                        <div class="qty-box">
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
                                                        <i class="ti-angle-left"></i>
                                                    </button> 
                                                </span>
                                                <input id="input-quantity"  type="text" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-prepend">
                                                    <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="">
                                                        <i class="ti-angle-right"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ODER BUTTON -->
                                    <div class="product-buttons">
                                        <?php echo $ajaxClickOrder;?>
                                    </div>
                                    <div class="border-product">
                                    	<?php echo $shortDescription;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="tab-product m-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-lg-12">
                                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" id="top-home-tab"
                                                data-toggle="tab" href="#top-home" role="tab"
                                                aria-selected="true">Mô tả sản phẩm</a>
                                            <div class="material-border"></div>
                                        </li>
                                    </ul>
                                    <div class="tab-content nav-material" id="top-tabContent">
                                        <div class="tab-pane fade show active ckeditor-content" id="top-home"
                                            role="tabpanel" aria-labelledby="top-home-tab">
                                            <pre></pre>
                                            <pre></pre>
											<?php echo $description;?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-sm-3 collection-filter">
                    <!-- SERVICE -->
                    <?php require_once BLOCK_PATH . 'service.php';?>
					<!-- END SERVICE -->
					<!-- BOOK SPECIAL -->
					<?php require_once BLOCK_PATH . 'bookSpecial.php';?>

					<!-- BOOK NEW -->
					<?php require_once BLOCK_PATH . 'bookNew.php'; ?>
                    
                </div>
            </div>
            <div class="row">
                <!-- Sách có liên quan -->
                <?php require_once BLOCK_PATH . 'bookRelate.php';?>
                
                
                
                
                
                
                
                
                
                
                
                                    