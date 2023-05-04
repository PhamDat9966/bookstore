<?php 

$xhtmlInfoCategory  = '';
$xhtmlQuickView     = '';

foreach ($this->Items as $valueInfoBook){
    
    $id                 = $valueInfoBook['id'];
    $nameBook           = $valueInfoBook['name'];
    $shortDescription   = $valueInfoBook['shortDescription'];
    $description        = $valueInfoBook['description'];
    
    $saleOff            = '';
    $price              = $valueInfoBook['price'];
    $priceNotSaleOFF    = '';
    if($valueInfoBook['sale_off'] > 0){
        $saleOff        = '<span class="lable4 badge badge-danger"> -'.$valueInfoBook['sale_off'].'%</span>';
        
        $priceNotSaleOFF= '<del>'.number_format($price).' đ</del>';   
        $price          = number_format($price * $valueInfoBook['sale_off'] / 100);
        $price          = $price.' đ ';
    } else{
        $price              = number_format($price);
    }

    //PICTURE
    $picture            =  UPLOAD_URL .'book' . DS . $valueInfoBook['picture'];
    $strSpecial1        = '\\';
    $strSpecial2        = "/";
    $picture            = str_replace($strSpecial1 ,$strSpecial2, $picture);

    $xhtmlInfoCategory .='<div class="col-xl-3 col-6 col-grid-box">
                            <div class="product-box">
                                <div class="img-wrapper">
                                    <div class="lable-block">
                                        '.$saleOff.'
                                    </div>
                                    <div class="front">
                                        <a href="item.html" class="bg-size blur-up lazyloaded" style="background-image: url(&quot;'.$picture.'&quot;); background-size: cover; background-position: center center; display: block;">
                                            <img src="'.$picture.'" class="img-fluid blur-up lazyload bg-img" alt="" style="display: none;">
                                        </a>
                                    </div>
                                    <div class="cart-info cart-wrap">
                                        <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                                        <a href="#" title="Quick View" id="quickView-'.$id.'" onclick="quickViewFunction('.$id.')"><i class="ti-search" data-toggle="modal" data-target="#quick-view" ></i></a>
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
                                    <a href="item.html" title="'.$nameBook.'">
                                        <h6>'.$nameBook.'</h6>
                                    </a>
                                    <p>'.$description.'</p>
                                    <h4 class="text-lowercase">'.$price.$priceNotSaleOFF.'</h4>
                                </div>
                            </div>
                        </div>';
    
}

?>
<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-title">
					<h2 class="py-2">Tất cả sách</h2>
				</div>
			</div>
		</div>
	</div>
</div>
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
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="my-text-primary" href="list.html">Bà mẹ - Em bé</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark " href="list.html">Chính Trị - Pháp Lý</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark " href="list.html">Học Ngoại Ngữ</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark " href="list.html">Công Nghệ Thông Tin</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark " href="list.html">Giáo Khoa - Giáo Trình</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark " href="list.html">Khoa Học - Kỹ Thuật</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark " href="list.html">Kiến Thức Tổng Hợp</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark " href="list.html">Lịch Sử</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark " href="list.html">Nông - Lâm - Ngư Nghiệp</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark " href="list.html">Tham Khảo</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark " href="list.html">Thường Thức - Gia Đình</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark more-item" href="list.html">Tâm Lý - Giới
											Tính</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark more-item" href="list.html">Tôn Giáo - Tâm
											Linh</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark more-item" href="list.html">Văn Hóa - Địa
											Lý - Du Lịch</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark more-item" href="list.html">Y Học</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark more-item" href="list.html">Kinh Tế</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark more-item" href="list.html">Kỹ Năng Sống</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark more-item" href="list.html">Thiếu Nhi</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark more-item" href="list.html">Truyện Tranh -
											Manga - Comic</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark more-item" href="list.html">Tạp chí -
											Catalogue</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark more-item" href="list.html">Từ Điển</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
										<a class="text-dark more-item" href="list.html">Điện Ảnh -
											Nhạc - Họa</a>
									</div>
									<div
										class="custom-control custom-checkbox collection-filter-checkbox pl-0 text-center">
										<span class="text-dark font-weight-bold" id="btn-view-more">Xem
											thêm</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="theme-card">
						<h5 class="title-border">Sách nổi bật</h5>
						<div class="offer-slider slide-1">
							<div>
								<div class="media">
									<a href="item.html"> <img class="img-fluid blur-up lazyload"
										src="images/product.jpg" alt="Cẩm Nang Cấu Trúc Tiếng Anh"></a>
									<div class="media-body align-self-center">
										<div class="rating">
											<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i>
										</div>

										<a href="item.html" title="Cẩm Nang Cấu Trúc Tiếng Anh">
											<h6>Cẩm Nang Cấu Trúc Tiếng Anh</h6>
										</a>
										<h4 class="text-lowercase">48,020 đ</h4>
									</div>
								</div>
								<div class="media">
									<a href="item.html"> <img class="img-fluid blur-up lazyload"
										src="images/product.jpg" alt="Cẩm Nang Cấu Trúc Tiếng Anh"></a>
									<div class="media-body align-self-center">
										<div class="rating">
											<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i>
										</div>

										<a href="item.html" title="Cẩm Nang Cấu Trúc Tiếng Anh">
											<h6>Cẩm Nang Cấu Trúc Tiếng Anh</h6>
										</a>
										<h4 class="text-lowercase">48,020 đ</h4>
									</div>
								</div>
								<div class="media">
									<a href="item.html"> <img class="img-fluid blur-up lazyload"
										src="images/product.jpg" alt="Cẩm Nang Cấu Trúc Tiếng Anh"></a>
									<div class="media-body align-self-center">
										<div class="rating">
											<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i>
										</div>

										<a href="item.html" title="Cẩm Nang Cấu Trúc Tiếng Anh">
											<h6>Cẩm Nang Cấu Trúc Tiếng Anh</h6>
										</a>
										<h4 class="text-lowercase">48,020 đ</h4>
									</div>
								</div>
								<div class="media">
									<a href="item.html"> <img class="img-fluid blur-up lazyload"
										src="images/product.jpg" alt="Cẩm Nang Cấu Trúc Tiếng Anh"></a>
									<div class="media-body align-self-center">
										<div class="rating">
											<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i>
										</div>

										<a href="item.html" title="Cẩm Nang Cấu Trúc Tiếng Anh">
											<h6>Cẩm Nang Cấu Trúc Tiếng Anh</h6>
										</a>
										<h4 class="text-lowercase">48,020 đ</h4>
									</div>
								</div>
							</div>
							<div>
								<div class="media">
									<a href="item.html"> <img class="img-fluid blur-up lazyload"
										src="images/product.jpg" alt="Cẩm Nang Cấu Trúc Tiếng Anh"></a>
									<div class="media-body align-self-center">
										<div class="rating">
											<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i>
										</div>

										<a href="item.html" title="Cẩm Nang Cấu Trúc Tiếng Anh">
											<h6>Cẩm Nang Cấu Trúc Tiếng Anh</h6>
										</a>
										<h4 class="text-lowercase">48,020 đ</h4>
									</div>
								</div>
								<div class="media">
									<a href="item.html"> <img class="img-fluid blur-up lazyload"
										src="images/product.jpg" alt="Cẩm Nang Cấu Trúc Tiếng Anh"></a>
									<div class="media-body align-self-center">
										<div class="rating">
											<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i>
										</div>

										<a href="item.html" title="Cẩm Nang Cấu Trúc Tiếng Anh">
											<h6>Cẩm Nang Cấu Trúc Tiếng Anh</h6>
										</a>
										<h4 class="text-lowercase">48,020 đ</h4>
									</div>
								</div>
								<div class="media">
									<a href="item.html"> <img class="img-fluid blur-up lazyload"
										src="images/product.jpg" alt="Cẩm Nang Cấu Trúc Tiếng Anh"></a>
									<div class="media-body align-self-center">
										<div class="rating">
											<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i> <i class="fa fa-star"></i> <i
												class="fa fa-star"></i>
										</div>

										<a href="item.html" title="Cẩm Nang Cấu Trúc Tiếng Anh">
											<h6>Cẩm Nang Cấu Trúc Tiếng Anh</h6>
										</a>
										<h4 class="text-lowercase">48,020 đ</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- silde-bar colleps block end here -->
				</div>
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
															<li class="my-layout-view" data-number="2"><img
																src="images/icon/2.png" alt=""
																class="product-2-layout-view"></li>
															<li class="my-layout-view" data-number="3"><img
																src="images/icon/3.png" alt=""
																class="product-3-layout-view"></li>
															<li class="my-layout-view active" data-number="4"><img
																src="images/icon/4.png" alt=""
																class="product-4-layout-view"></li>
															<li class="my-layout-view" data-number="6"><img
																src="images/icon/6.png" alt=""
																class="product-6-layout-view"></li>
														</ul>
													</div>
													<div class="product-page-filter">
														<form action="" id="sort-form" method="GET">
															<select id="sort" name="sort">
																<option value="default" selected>- Sắp xếp -</option>
																<option value="price_asc">Giá tăng dần</option>
																<option value="price_desc">Giá giảm dần</option>
																<option value="latest">Mới nhất</option>
															</select>
														</form>
													</div>
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
																<ul class="pagination">
																	<li class="page-item disabled"><a href=""
																		class="page-link"><i class="fa fa-angle-double-left"></i></a>
																	</li>
																	<li class="page-item disabled"><a href=""
																		class="page-link"><i class="fa fa-angle-left"></i></a>
																	</li>
																	<li class="page-item active"><a class="page-link">1</a>
																	</li>
																	<li class="page-item"><a class="page-link" href="#">2</a>
																	</li>
																	<li class="page-item"><a class="page-link" href="#">3</a>
																	</li>
																	<li class="page-item"><a class="page-link" href="#"><i
																			class="fa fa-angle-right"></i></a></li>
																	<li class="page-item"><a class="page-link" href="#"><i
																			class="fa fa-angle-double-right"></i></a></li>
																</ul>
															</nav>
														</nav>
													</div>
													<div class="col-xl-6 col-md-6 col-sm-12">
														<div class="product-search-count-bottom">
															<h5>Showing Items 1-12 of 55 Result</h5>
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

<!-- Quick view -->
<div class="modal fade bd-example-modal-lg theme-modal" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content quick-view-modal">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                <div class="row">
                	<!--content quick view -->
                    <div class="col-lg-6 col-xs-12">
                        <div class="quick-view-img"><img id="quick-view-img" src="<?php echo $this->_urlImg; ?>/quick-view-bg.jpg" alt="" class="w-100 img-fluid blur-up lazyload book-picture"></div>
                    </div>
                    <div class="col-lg-6 rtl-text">
                        <div class="product-right" id="quick-view-content">
                            <h2 class="book-name" id="book-name">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores,
                                distinctio.</h2>
                            <h3 class="book-price" id="price">26.910 ₫ <del id="price-not-off">39.000 ₫</del></h3>
                            <div class="border-product">
                                <div class="book-description" id="book-description">Lorem ipsum dolor sit amet consectetur, adipisicing
                                    elit. Unde quae cupiditate delectus laudantium odio molestiae deleniti facilis
                                    itaque ut vero architecto nulla officiis in nam qui, doloremque iste. Incidunt,
                                    in?</div>
                            </div>
                            <div class="product-description border-product">
                                <h6 class="product-title">Số lượng</h6>
                                <div class="qty-box">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
                                                <i class="ti-angle-left"></i>
                                            </button>
                                        </span>
                                        <input type="text" name="quantity" class="form-control input-number" value="1">
                                        <span class="input-group-prepend">
                                            <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="">
                                                <i class="ti-angle-right"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-buttons">
                                <a href="#" class="btn btn-solid mb-1 btn-add-to-cart">Chọn Mua</a>
                                <a href="item.html" class="btn btn-solid mb-1 btn-view-book-detail">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    <!--end content quick view -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Quick view -->













