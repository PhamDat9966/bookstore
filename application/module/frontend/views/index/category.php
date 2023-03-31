<?php 
$imageURL           = $this->_urlImg;
$strSpecial1        = '\\';
$strSpecial2        = "/";
$imageURL           = str_replace($strSpecial1 ,$strSpecial2, $imageURL);

$modul          = new Model();
$query          = 'SELECT `id`,`name`,`picture` FROM `category` WHERE `status`= 1 ORDER BY `ordering` ASC';
$listCategory   = $modul->fetchAll($query);

$xhtml = '';

foreach ($listCategory as $keyCats=>$valueCats){
    $imgURL =  UPLOAD_URL .'category' . DS . $valueCats['picture'];
    $strSpecial1        = '\\';
    $strSpecial2        = "/";
    $imgURL           = str_replace($strSpecial1 ,$strSpecial2, $imgURL);
    
    $xhtml .= '<div class="product-box">
                <div class="img-wrapper">
                    <div class="front">
                        <a href="list.html"><img src="' .$imgURL. '" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                    </div>
                </div>
                <div class="product-detail">
                    <a href="list.html">
                        <h4>'.$valueCats['name'].'</h4>
                    </a>
                </div>
            </div>';
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
                                    <ul class="pagination">
                                        <li class="page-item disabled">
                                            <a href="" class="page-link"><i class="fa fa-angle-double-left"></i></a>
                                        </li>
                                        <li class="page-item disabled">
                                            <a href="" class="page-link"><i class="fa fa-angle-left"></i></a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fa fa-angle-right"></i></a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fa fa-angle-double-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </nav>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12">
                            <div class="product-search-count-bottom">
                                <h5>Showing Items 1-15 of 22 Result</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>