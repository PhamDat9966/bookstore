<?php
require_once LIBRARY_PATH . 'Model.php';
$modelNew     = new Model();

$queryContent       = [];
$queryContent[]     = "SELECT `b`.`id`,`b`.`name`,`b`.`shortDescription`,`b`.`picture`,`b`.`price`,`b`.`sale_off`,(`b`.`price`-`b`.`price`*`b`.`sale_off`/100) AS `priceReal`,`b`.`category_id`,`b`.`created`,`b`.`created_by`,`b`.`modified`,`b`.`modified_by`,`b`.`status`,`b`.`special`,`b`.`ordering`,`c`.`name` AS `category_name`";
$queryContent[]     = "FROM (SELECT * FROM `".TBL_BOOK."` ORDER BY `id` DESC LIMIT 9) AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";
$queryContent[]     = "WHERE `b`.`category_id` = `c`.`id`";
$queryContent[]     = "AND `b`.`status` = 1";
$queryContent[]     = 'ORDER BY `b`.`ordering` ASC';

$queryContent       = implode(" ", $queryContent);
$resulfRelate       = $modelNew->fetchAll($queryContent);

//Trộn mảng Kết quả cho ra 1 mảng ngẫu nhiên mới với mảng cũ
require_once LIBRARY_PATH . 'functions.php';
$resulfRelate    = mixArray($resulfRelate);

$xhtmlNewBook = '';
$idContinue = 0;

// Phân chia mục "sách mới" làm 3 ngăn, mỗi ngăn có 3 quyển sách
for($i=0;   $i<=2;  $i++){
    $numberItem = 0;
    $xhtmlNewBook .= '<div>';
    
    for($j=0;   $j<=2;  $j++){
        if($numberItem == 3){
            $numberItem = 0;
            break;
        }
        $idNew      = $resulfRelate[$idContinue]['id'];
        $nameNew    = $resulfRelate[$idContinue]['name'];
        
        $catID      = $resulfRelate[$idContinue]['category_id'];
        
        $bookNameURL    = Helper::replaceSpecialChar($resulfRelate[$idContinue]['name']);
        $bookNameURL    = Helper::replaceNumberChar($bookNameURL);
        $bookNameURL    = URL::filterURL($bookNameURL);
        $catNameURL     = URL::filterURL($resulfRelate[$idContinue]['category_name']);
        
        $picture     = Helper::createImageURL('book',$resulfRelate[$idContinue]['picture']);
        
        $sale_off           = $resulfRelate[$idContinue]['sale_off'];
        $price              = $resulfRelate[$idContinue]['price'];
        $priceReal          = 0;
        if($resulfRelate[$j]['sale_off'] > 0){
            $priceReal           = number_format($price * (100 - $resulfRelate[$idContinue]['sale_off']) / 100);;
        } else{
            $priceReal         = number_format($price);
        }
        
        $linkNew    = URL::createLink('frontend', 'book', 'detail',array('book_id'=>$idNew), null, null,"$catNameURL/$bookNameURL-$catID-$idNew.html");
        
        $xhtmlNewBook .='<div class="media">
                        <a href="'.$linkNew.'">
                            <img class="img-fluid blur-up lazyload" src="'.$picture.'" alt="'.$nameNew.'"></a>
                        <div class="media-body align-self-center">
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <a href="'.$linkNew.'" title="'.$nameNew.'">
                                <h6>'.$nameNew.'</h6>
                            </a>
                            <h4 class="text-lowercase">'.$priceReal.' đ</h4>
                        </div>
                    </div>';
        
        $numberItem++;
        $idContinue++;
    }
    $xhtmlNewBook .= '</div>';
}

?>

<div class="theme-card mt-4">
    <h5 class="title-border">Sách mới</h5>
    <div class="offer-slider slide-1">
		<?php 
		  echo $xhtmlNewBook;
		?>
    </div>
</div>













