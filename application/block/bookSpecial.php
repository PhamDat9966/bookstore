<?php
require_once LIBRARY_PATH . 'Model.php';
$model              = new Model();
$queryContent       = [];
$queryContent[]     = "SELECT `b`.`id`,`b`.`name`,`b`.`shortDescription`,`b`.`picture`,`b`.`price`,`b`.`sale_off`,(`b`.`price`-`b`.`price`*`b`.`sale_off`/100) AS `priceReal`,`b`.`category_id`,`b`.`created`,`b`.`created_by`,`b`.`modified`,`b`.`modified_by`,`b`.`status`,`b`.`special`,`b`.`ordering`,`c`.`name` AS `category_name`";
$queryContent[]     = "FROM `".TBL_BOOK."` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";
$queryContent[]     = "WHERE `b`.`category_id` = `c`.`id`";
$queryContent[]     = "AND `b`.`status` = 1 AND `b`.`special` = 1";
$queryContent[]     = 'ORDER BY `b`.`ordering` ASC';

$queryContent       = implode(" ", $queryContent);
$resulf             = $model->fetchAll($queryContent);

//Trộn mảng Kết quả cho ra 1 mảng ngẫu nhiên mới với mảng cũ
require_once LIBRARY_PATH . 'functions.php';
$dataBookSpecial    = mixArray($resulf);

$numberBookSpecial  = 0;

$xhtmlBookSpecial    = '';
$xhtmlBookSpecial   .= '<div>';

foreach ($dataBookSpecial as $keySpecial=>$valueSpecial){
    
    if($numberBookSpecial == 12){ // Đến 12 thì dủ 3 ngăn, dừng lại tại đây
        break;
    }
    
    // Cắt ngăn
    if($numberBookSpecial == 4 || $numberBookSpecial == 8 || $numberBookSpecial == 12){ // Sách mới có 3 ngăn, đến 12 là dừng. Tạm để 12 cho nhớ cách làm.
        $xhtmlBookSpecial .= '</div><div>'; 
    }
    
    $idSpecial      = $valueSpecial['id'];
    $nameSpecial    = $valueSpecial['name'];
    $catID          = $valueSpecial['category_id'];
    
    $bookNameURL    = Helper::replaceSpecialChar($valueSpecial['name']);
    $bookNameURL    = Helper::replaceNumberChar($bookNameURL);
    $bookNameURL    = URL::filterURL($bookNameURL);
    $catNameURL     = URL::filterURL($valueSpecial['category_name']);
    
    $urlSpecial     = URL::createLink('frontend', 'book', 'detail',array('book_id'=>$idSpecial), null, null, "$catNameURL/$bookNameURL-$catID-$idSpecial.html");
    
    $pictureSpecial = Helper::createImageURL('book',$valueSpecial['picture']);
    
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
    

    $numberBookSpecial++;
}

$xhtmlBookSpecial .= '</div>';
?>
					<div class="theme-card">
						<h5 class="title-border">Sách nổi bật</h5>
						<div class="offer-slider slide-1">
							<?php 
							    echo $xhtmlBookSpecial;
							?>
						</div>
					</div>
					<!-- silde-bar colleps block end here -->
