<?php 

// echo "<pre>";
// print_r($this->bookCategoryProduct);
// echo "</pre>";
/* Đanh Mục Nổi Bật */
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
    if($first_key_Category == $keyCatList){
        $xhtmlCategoryInfo .='<div id="tab-category-'.$keyCatList.'" class="tab-content active default">';
        
        $xhtmlCategoryInfo .=   '<div class="no-slider row tab-content-inside">';
        foreach ($this->bookCategoryProduct as $keyBookInCat=>$valueBookInCat){
            $nameBook         = $valueBookInCat['name'];
            
            $picture          = UPLOAD_URL .'book' . DS . $valueBookInCat['picture'];
            $strSpecial1       = '\\';
            $strSpecial2       = "/";
            $picture          = str_replace($strSpecial1 ,$strSpecial2, $picture);
            
            $shortDescription = $valueBookInCat['shortDescription'];
            $sale_off         = $valueBookInCat['sale_off'];
            
            $price              = $valueBookInCat['price'];
            $priceNotSaleOFF    = '';
            if($valueBookInCat['sale_off'] > 0){
                $priceNotSaleOFF= '<del>'.number_format($price).' đ</del>';
                $price          = number_format($price * (100 - $valueBookInCat['sale_off']) / 100);
                $price          = $price.' đ ';
            } else{
                $price              = number_format($price);
            }
            if($keyCatList == $valueBookInCat['category_id']){
                $xhtmlCategoryInfo .=   '<div class="product-box">
                                            <div class="img-wrapper">
                                                <div class="lable-block">
                                                    <span class="lable4 badge badge-danger"> -'.$sale_off.'%</span>
                                                </div>
                                                <div class="front">
                                                    <a href="item.html">
                                                        <img src="'.$picture.'" class="img-fluid blur-up lazyload bg-img" alt="product">
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
                                                <a href="item.html" title="'.$shortDescription.'"
                                                    <h6>'.$shortDescription.'</h6>
                                                </a>
                                                <h4 class="text-lowercase">'.$price.'<del>'.$priceNotSaleOFF.'</del></h4>
                                            </div>
                                        </div>';
            }
        }
        $xhtmlCategoryInfo .= '</div>';
        
        $xhtmlCategoryInfo .='</div>';
    }else{
        $xhtmlCategoryInfo .='<div id="tab-category-'.$keyCatList.'" class="tab-content">';
        $xhtmlCategoryInfo .=   '<div class="no-slider row tab-content-inside">';
        foreach ($this->bookCategoryProduct as $keyBookInCat=>$valueBookInCat){
            $nameBook         = $valueBookInCat['name'];
            
            $picture          = UPLOAD_URL .'book' . DS . $valueBookInCat['picture'];
            $strSpecial1       = '\\';
            $strSpecial2       = "/";
            $picture          = str_replace($strSpecial1 ,$strSpecial2, $picture);
            
            $shortDescription = $valueBookInCat['shortDescription'];
            $sale_off         = $valueBookInCat['sale_off'];
            
            $price              = $valueBookInCat['price'];
            $priceNotSaleOFF    = '';
            if($valueBookInCat['sale_off'] > 0){
                $priceNotSaleOFF= '<del>'.number_format($price).' đ</del>';
                $price          = number_format($price * (100 - $valueBookInCat['sale_off']) / 100);
                $price          = $price.' đ ';
            } else{
                $price              = number_format($price);
            }
            if($keyCatList == $valueBookInCat['category_id']){
                $xhtmlCategoryInfo .=   '<div class="product-box">
                                            <div class="img-wrapper">
                                                <div class="lable-block">
                                                    <span class="lable4 badge badge-danger"> -'.$sale_off.'%</span>
                                                </div>
                                                <div class="front">
                                                    <a href="item.html">
                                                        <img src="'.$picture.'" class="img-fluid blur-up lazyload bg-img" alt="product">
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
                                                <a href="item.html" title="'.$shortDescription.'"
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
   
}
    $xhtmlCategoryInfo .= '<div class="text-center">
                			<a href="list.html" class="btn btn-solid">Xem tất cả</a>
                		</div>';
    
$xhtmlCategoryInfo .= '</div>';



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
<!-- 						<li class="current"><a href="tab-category-1" class="my-product-tab" data-category="1">Bà mẹ -->
<!--                                 - Em bé</a></li> -->
<!--                         <li><a href="tab-category-5" class="my-product-tab" data-category="5">Học Ngoại Ngữ</a></li> -->
<!--                         <li><a href="tab-category-3" class="my-product-tab" data-category="3">Công Nghệ Thông -->
<!--                                 Tin</a></li> -->
                    </ul>
                    
                    <?php 
                      echo $xhtmlCategoryInfo;
                    ?>
                    
                    <?php 
                        //require_once 'category_Product.php';
                    ?>    
                        
                </div>
            </div>
        </div>
    </div>
</section>