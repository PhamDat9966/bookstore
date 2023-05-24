<?php
require_once LIBRARY_PATH . 'Model.php';
$modelNew     = new Model();
$queryContent = 'SELECT `id`,`name`,`picture`,`sale_off`,`price` FROM
                    (
                     SELECT * FROM `book` ORDER BY id DESC LIMIT 9
                    ) AS sub WHERE `status` = 1 ORDER BY id ASC';
$resulfRelate       = $modelNew->fetchAll($queryContent);

// echo "<pre>";
// print_r($resulfRelate);
// echo "</pre>";
$xhtmlNewBook = '';

// foreach ($resulfRelate as $keyNew=>$valueNew){
//     $idNew      = $valueNew['id'];
//     $nameNew    = $valueNew['name'];
//     $picture    = UPLOAD_URL . 'book' . DS . $valueNew['picture'];
    
//     $sale_off           = $valueNew['sale_off'];
//     $price              = $valueNew['price'];
//     $priceReal          = 0;
//     if($valueNew['sale_off'] > 0){
//         $priceReal           = number_format($price * (100 - $valueNew['sale_off']) / 100);;
//     } else{
//         $priceReal         = number_format($price);
//     }
    
//     $linkNew    = URL::createLink('frontend', 'book', 'detail',array('book_id'=>$idNew));
    
//     $xhtmlNewBook .='<div class="media">
//                         <a href="'.$linkNew.'">
//                             <img class="img-fluid blur-up lazyload" src="'.$picture.'" alt="'.$nameNew.'"></a>
//                         <div class="media-body align-self-center">
//                             <div class="rating">
//                                 <i class="fa fa-star"></i> 
//                                 <i class="fa fa-star"></i> 
//                                 <i class="fa fa-star"></i> 
//                                 <i class="fa fa-star"></i> 
//                                 <i class="fa fa-star"></i>
//                             </div>
//                             <a href="'.$linkNew.'" title="'.$nameNew.'">
//                                 <h6>'.$nameNew.'</h6>
//                             </a>
//                             <h4 class="text-lowercase">'.$priceReal.' đ</h4>
//                         </div>
//                     </div>';
// }

$idContinue = 0;

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
        $picture    = UPLOAD_URL . 'book' . DS . $resulfRelate[$idContinue]['picture'];
        
        $sale_off           = $resulfRelate[$idContinue]['sale_off'];
        $price              = $resulfRelate[$idContinue]['price'];
        $priceReal          = 0;
        if($resulfRelate[$j]['sale_off'] > 0){
            $priceReal           = number_format($price * (100 - $resulfRelate[$idContinue]['sale_off']) / 100);;
        } else{
            $priceReal         = number_format($price);
        }
        
        $linkNew    = URL::createLink('frontend', 'book', 'detail',array('book_id'=>$idNew));
        
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
    //echo $idContinue.'</br>';
    $xhtmlNewBook .= '</div>';
    echo $xhtmlNewBook;
}

?>













