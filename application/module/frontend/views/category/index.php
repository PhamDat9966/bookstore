<?php 
// $imageURL           = $this->_urlImg;
// $strSpecial1        = '\\';
// $strSpecial2        = "/";
// $imageURL           = str_replace($strSpecial1 ,$strSpecial2, $imageURL);


$xhtml = '';

foreach ($this->Items as $keyCats=>$valueCats){
    $imgURL =  UPLOAD_URL .'category' . DS . $valueCats['picture'];
    $strSpecial1        = '\\';
    $strSpecial2        = "/";
    $imgURL           = str_replace($strSpecial1 ,$strSpecial2, $imgURL);
    
    $urlCategory      = URL::createLink('frontend', 'book', 'list', array('category_id'=>$valueCats['id']));  
    
    $xhtml .= '<div class="product-box">
                    <div class="img-wrapper">
                        <div class="front">
                            <a href="'.$urlCategory.'"><img src="' .$imgURL. '" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <a href="'.$urlCategory.'">
                            <h4>'.$valueCats['name'].'</h4>
                        </a>
                    </div>
                </div>';
}

$pagination = $this->Pagination['paginationHTML'];
$allItems   = $this->_count['activeStatus'];

$startNumberItems = 1 + $this->Pagination['position'];
$endNumberItems   = $this->Pagination['position'] + $this->Pagination['totalItemsPerPage'];
if($endNumberItems > $allItems){
    $endNumberItems = $allItems;
}

?>

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2">Danh mục sách</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ratio_asos j-box pets-box section-b-space" id="category">
    <div class="container">
        <div class="no-slider five-product row">
  			<?php echo $xhtml;?>
        </div>

        <div class="product-pagination">
            <div class="theme-paggination-block">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12">
                            <nav aria-label="Page navigation">
                                <nav>
                                   <?php 
                                        echo $pagination;
                                   ?>
                                </nav>
                            </nav>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12">
                            <div class="product-search-count-bottom">
                                <h5>Showing Items <?php echo $startNumberItems;?>-<?php echo $endNumberItems;?> of <?php echo $allItems;?> Result</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>