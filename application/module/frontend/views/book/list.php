<?php 

$urlBookInfo        = '';
$xhtmlInfoCategory  = '';
$xhtmlQuickView     = '';

foreach ($this->Items as $valueInfoBook){
    
    $id                 = $valueInfoBook['id'];
    $catID              = $valueInfoBook['category_id'];
    
    $bookNameURL        = Helper::replaceSpecialChar($valueInfoBook['name']); 
    $bookNameURL        = Helper::replaceNumberChar($bookNameURL); 
    $bookNameURL        = URL::filterURL($bookNameURL);
    $catNameURL         = URL::filterURL($valueInfoBook['category_name']);    
    
    require_once LIBRARY_EXT_PATH .'highlight.php';
    $highLight          = new Highlighter();
    $highLight->setTag('mark');

    $arrSearch          = array();
    $arrSearch[]        = @$this->arrParam['search'];
    $nameBook           = $highLight->highlight($valueInfoBook['name'], $arrSearch);
    
    $shortDescription   = $valueInfoBook['shortDescription'];
    //$description        = $valueInfoBook['description'];
    
    $saleOff            = '';
    $price              = $valueInfoBook['price'];
    $priceNotSaleOFF    = '';
    $priceReal          = 0;
    if($valueInfoBook['sale_off'] > 0){
        $priceReal      = $price * (100 - $valueInfoBook['sale_off']) / 100;
        $saleOff        = '<span class="lable4 badge badge-danger"> -'.$valueInfoBook['sale_off'].'%</span>';
        
        $priceNotSaleOFF= '<del>'.number_format($price).' đ</del>';   
        $price          = number_format($price * (100 - $valueInfoBook['sale_off']) / 100);
        $price          = $price.' đ ';
    } else{
        $priceReal      = $price;
        $price          = number_format($price);
    }

    //PICTURE
    $pictureURL         = Helper::createImageURL('book', $valueInfoBook['picture']);
    $picture            = Helper::createImageShort('book', $valueInfoBook['picture'],array('class'=>'img-fluid blur-up lazyload bg-img'),array('display'=>'none'));
    
    $urlBookInfo        = URL::createLink('frontend', 'book', 'detail',array('category_id'=>$catID,'book_id'=>$id), null, null,"$catNameURL/$bookNameURL-$catID-$id.html");
    
    $attrAtagBookPic    = array('class'=>'bg-size blur-up lazyloaded');
    $styleAtagBookPic   = array(
                                    'background-image'      =>$pictureURL,
                                    'background-size'       =>'cover',
                                    'background-position'   =>' center center',
                                    'display'               =>'block'
                                );
    $tabIndex           = '-1';
    
    $aTagBookPicture    = Helper::createImageATag($urlBookInfo,$attrAtagBookPic,$styleAtagBookPic,$picture,$tabIndex);
    
    /* Ajax Order add cart*/
    $linkOrderJSONDetail      = URL::createLink('frontend', 'user', 'ajaxOrder',array('book_id'=>$id,'price'=>$priceReal,'quantity'=>1));
    $linkOrderJSONDetail      = json_encode($linkOrderJSONDetail);
    $linkOrderJSONDetail      = htmlentities($linkOrderJSONDetail);
    
    $session_flag_stop         = FALSE;
    /* Ajax Order Trường hợp chưa đăng nhập */
    if(!isset($_SESSION['user'])){
        $linkOrderJSONDetail  = Null;
        $session_flag_stop    = TRUE;
    }
    
    
    $urlQuickView       = URL::createLink('frontend', 'book', 'quickView');
    $arrQuickView       = array(
                                'book_id'=>$id,
                                'url'=>$urlQuickView,
                                'session_flag_stop' => $session_flag_stop
                          );
    
    $jsonQuickView      = json_encode($arrQuickView);
    $jsonQuickView      = htmlentities($jsonQuickView);
    

    
    $xhtmlInfoCategory .='<div class="col-xl-3 col-6 col-grid-box">
                            <div class="product-box">
                                <div class="img-wrapper">
                                    <div class="lable-block">
                                        '.$saleOff.'
                                    </div>
                                    <div class="front">
                                        '.$aTagBookPicture.'
                                    </div>
                                    <div class="cart-info cart-wrap">
                                        <a href="#" onclick="ajaxOrder(\''.$linkOrderJSONDetail.'\')" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                                        <a href="#" title="Quick View" id="quickView-'.$id.'" onclick="quickViewFunction('.$jsonQuickView.')"><i class="ti-search" data-toggle="modal" data-target="#quick-view" ></i></a>
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
                                    <a href="'.$urlBookInfo.'" title="'.$nameBook.'">
                                        <h6>'.$nameBook.'</h6>
                                    </a>
                                    <p>'.$shortDescription.'</p>
                                    <h4 class="text-lowercase">'.$price.$priceNotSaleOFF.'</h4>
                                </div>
                            </div>
                        </div>';
    
    // Order Tại QuickView: Thẻ chọn mua
    $linkOrder          = URL::createLink('frontend', 'user', 'ajaxOrder',array('book_id'=>$valueInfoBook['id'],'price'=>$priceReal));
    $linkOrder          = json_encode($linkOrder);
    $linkOrderJSON      = htmlentities($linkOrder);
    
    /* Trường hợp chưa đăng nhập */
    if(!isset($_SESSION['user'])){
        $linkOrderJSON = Null;
    }
    
    $ajaxClickOrderQuickView     = '<a onclick="ajaxOrderQuickView(\''.$linkOrderJSON.'\')" href="#" class="btn btn-solid mb-1 btn-add-to-cart">Chọn Mua</a>';
    
}

$nameCategory = $this->categoryName;
$navigation   = $this->Pagination['paginationHTML'];
?>
<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-title">
					<h2 class="py-2"><?php echo $nameCategory;?></h2>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 

//LEFT MENU CATEGORY
//$listCategoryMenu = $this->category_menu; //Từ header_navigation

// lấy danh sách category  tu modul
$modul              = new Model();
$query              = 'SELECT `id`,`name` FROM `category` WHERE `status`= 1 ORDER BY `ordering` ASC';
$listCategoryMenu   = $modul->fetchPairs($query);

$categoryID       = '';
if(isset($this->arrParam['category_id'])){
    $categoryID       = $this->arrParam['category_id'];
}

$activeMenu       = '';

$xhtmlCategoryList = '';
foreach ($listCategoryMenu as $keyCategory=>$valueCategory){
    $idCat              = $keyCategory;
    $nameCat            = $valueCategory;
    $nameCatURL         = URL::filterURL($nameCat);
    
    $linkCategory       = URL::createLink('frontend', 'book', 'list', array('category_id'=>$keyCategory), null , null , "$nameCatURL-$idCat.html");
    $activeMenu         = ($categoryID == $keyCategory)? 'my-text-primary' : 'text-dark';
    $xhtmlCategoryList .= '<div
							class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
							<a class="'.$activeMenu.'" href="'.$linkCategory.'">'.$valueCategory.'</a>
						</div>';
}

?>

<section class="section-b-space j-box ratio_asos">
	<div class="collection-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 collection-filter">
					<!-- side-bar colleps block stat -->
					<div class="collection-filter-block">
						<!-- brand filter start -->
						<div class="collection-mobile-back">
							<span class="filter-back"><i class="fa fa-angle-left"
								aria-hidden="true"></i> back</span>
						</div>
						<div class="collection-collapse-block open">
							<h3 class="collapse-block-title">Danh mục</h3>
							<div class="collection-collapse-block-content">
								<div class="collection-brand-filter">
									<?php 
									   echo $xhtmlCategoryList;
									?>
								</div>
    					        <div
                                    class="custom-control custom-checkbox collection-filter-checkbox pl-0 text-center">
                                    <span class="text-dark font-weight-bold" id="btn-view-more">Xem thêm</span>
                                </div>
							</div>
						</div>
					</div>
					
					<!-- SPECIAL BOOK  -->
    					<?php 
    					    require_once BLOCK_PATH . 'bookSpecial.php';
    					?>
	
					<!-- silde-bar colleps block end here -->
				</div>
<?php 
//FILTER AND SEARCH
$arrDocking = array(2,3,4,6);
$xhtmlDocking = '';
foreach ($arrDocking as $valueDocking){
    
    $icon          = Helper::createImageURL('icon', $valueDocking.'.png');
    $xhtmlDocking .= '<li class="my-layout-view" data-number="'.$valueDocking.'">
                        <img src="'.$icon.'" alt="" class="product-'.$valueDocking.'-layout-view">
                    </li>';
}

$totalItem      = $this->_count['totalItem'];
$position       = $this->Pagination['position'];
$endPosition    = $this->Pagination['position'] + $this->Pagination['totalItemsPerPage'];

if($endPosition > $totalItem){
    $endPosition = $totalItem;
}
$positionStart   = $position + 1;// posion là 0, vậy không show số không ra phần resutf
?>				
				
				
				<div class="collection-content col">
					<div class="page-main-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="collection-product-wrapper">
									<div class="product-top-filter">
										<div class="row">
											<div class="col-xl-12">
												<div class="filter-main-btn">
													<span class="filter-btn btn btn-theme"><i
														class="fa fa-filter" aria-hidden="true"></i> Filter</span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<div class="product-filter-content">
													<div class="collection-view">
														<ul>
															<li><i class="fa fa-th grid-layout-view"></i></li>
															<li><i class="fa fa-list-ul list-layout-view"></i></li>
														</ul>
													</div>
													<div class="collection-grid-view">
														<ul>
															<?php 
															     echo $xhtmlDocking;
															?>
														</ul>
													</div>
													<?php 
													   require_once BLOCK_PATH . 'sortForm.php';
													?>
<!-- 													<div class="product-page-filter"> -->
<!-- 														<form action="" id="sort-form" method="GET"> -->
<!-- 															<select id="sort" name="sort"> -->
<!-- 																<option value="default" selected>- Sắp xếp -</option> -->
<!-- 																<option value="price_asc">Giá tăng dần</option> -->
<!-- 																<option value="price_desc">Giá giảm dần</option> -->
<!-- 																<option value="latest">Mới nhất</option> -->
<!-- 															</select> -->
<!-- 														</form> -->
<!-- 													</div> -->
												</div>
											</div>
										</div>
									</div>
									<div class="product-wrapper-grid" id="my-product-list">
										<div class="row margin-res">
												<?php
                                                    echo $xhtmlInfoCategory;
                                                 ?>		
                                            </div>
									</div>
									<div class="product-pagination">
										<div class="theme-paggination-block">
											<div class="container-fluid p-0">
												<div class="row">
													<div class="col-xl-6 col-md-6 col-sm-12">
														<nav aria-label="Page navigation">
															<nav>
																<?php 
																    echo $navigation;
																?>
															</nav>
														</nav>
													</div>
													<div class="col-xl-6 col-md-6 col-sm-12">
														<div class="product-search-count-bottom">
															<h5>Showing Items <?php echo $positionStart;?>-<?php echo $endPosition;?> of <?php echo $totalItem;?> Result</h5>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
    /*----------QUICK VIEW---------------*/
    require_once BLOCK_PATH . 'quickView.php';
?>












