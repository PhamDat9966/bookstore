<?php
// echo "<pre>";
// print_r($bookInfo);
// echo "</pre>";
$bookComp     = $this->Book;
$bookNameComp = $bookComp['name'];
$pictureComp  = UPLOAD_URL .'book' . DS . $bookComp['picture'];;
?>
<div class="modal fade bd-example-modal-lg theme-modal" id="quick-view-complete-order" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div id="background-quick-view-order" class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content quick-view-modal">
            <div id="quick-view-order-body" class="modal-body" style="background-color: green;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" id="quick-view-complete-order-hiddent" onclick='hiddentOrder()' >X</span></button>
                <div class="row" style="background-color: white;">
                    <div class="col-lg-3 col-xs-12">
                        <div class="quick-view-img"><img src="<?php echo $pictureComp;?>" alt="Picture Order Complete" width="50" height="50" class="w-100 img-fluid blur-up book-picture lazyloaded"></div>
                    </div>
                    <div class="col-lg-9 rtl-text">
                    	<div class="product-right" id="quick-view-content">
                            <div class="pt-5">
                                <p style="font-size: 18px;">Sản Phẩm <strong><?php echo $bookNameComp;?></strong> đã được thêm vào giỏ hàng</p>
                                <div class="product-buttons mt-2">
                                    <a href="#" class="btn btn-solid mb-1 btn-add-to-cart">Xem Giỏ Hàng</a>
                                    <a href="#" class="btn btn-solid mb-1 btn-view-book-detail">Tiếp Tục Mua Sắm</a>
                                </div>
                            </div>
                         </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

