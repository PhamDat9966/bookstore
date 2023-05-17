<?php
require_once LIBRARY_PATH . 'Model.php';
$model              = new Model();
$queryContent       = [];
$queryContent[]     = "SELECT `id`,`name`,`picture`,`price`,`sale_off`";
$queryContent[]     = "FROM `".TBL_BOOK."`";
$queryContent[]     = "WHERE `status` = 1 AND `special` = 1";
$queryContent[]     = 'ORDER BY `ordering` ASC';

$queryContent       = implode(" ", $queryContent);
$resulf             = $model->fetchAll($queryContent);

//Trộn mảng Kết quả cho ra 1 mảng ngẫu nhiên mới với mảng cũ
require_once LIBRARY_PATH . 'functions.php';
$dataBookSpecial = mixArray($resulf);

$xhtmlBookSpecial   = '';

$numberBookShow     = 0;
foreach ($dataBookSpecial as $keySpecial=>$valueSpecial){
    if($numberBookShow == 4){
        break;
    }
    $idSpecial      = $valueSpecial['id'];
    $nameSpecial    = $valueSpecial['name'];
    $urlSpecial     = URL::createLink('frontend', 'book', 'detail',array('book_id'=>$idSpecial));
    
    $pictureSpecial     = UPLOAD_URL .'book' . DS . $valueSpecial['picture'];
    $strSpecial1        = '\\';
    $strSpecial2        = "/";
    $pictureSpecial     = str_replace($strSpecial1 ,$strSpecial2, $pictureSpecial);
    
    
    $priceSpecial              = $valueSpecial['price'];
    if($valueSpecial['sale_off'] > 0){
        $priceSpecial           = number_format($priceSpecial * (100 - $valueSpecial['sale_off']) / 100).' đ ';;
    } else{
        $priceSpecial           = number_format($priceSpecial).' đ ';;
    }
    
    $xhtmlBookSpecial .='<div class="media">
									<a href="'.$urlSpecial.'"> <img class="img-fluid blur-up lazyload"
										src="'.$pictureSpecial.'" alt="'.$nameSpecial.'"></a>
									<div class="media-body align-self-center">
										<div class="rating">
											<i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i>
										</div>
										    
										<a href="'.$urlSpecial.'" title="'.$nameSpecial.'">
											<h6>'.$nameSpecial.'</h6>
										</a>
										<h4 class="text-lowercase">'.$priceSpecial.'</h4>
									</div>
								</div>';
    $numberBookShow++;
}
?>
					<div class="theme-card">
						<h5 class="title-border">Sách nổi bật</h5>
						<div class="offer-slider slide-1">
							<div>
								<?php 
								    echo $xhtmlBookSpecial;
								?>
							</div>
						</div>
					</div>
					<!-- silde-bar colleps block end here -->
