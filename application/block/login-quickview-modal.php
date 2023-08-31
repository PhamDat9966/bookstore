<?php
$login        = URL::createLink('frontend', 'index', 'login', null, null, null, 'login.html');
?>
<div class="modal fade bd-example-modal-lg theme-modal" id="quick-view-login" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div id="background-quick-view-order" class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content quick-view-modal">
            <div id="quick-view-order-body" class="modal-body" style="background-color: green;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" id="quick-view-complete-order-hiddent" onclick='hiddentOrder()' >X</span></button>
                <div class="row" style="background-color: white;">
                    <div class="col-lg-12 rtl-text">
                    	<div class="product-right" id="quick-view-content">
                            <div class="pt-12 gap-3">
                                <p style="font-size: 18px;" class="text-center p-2">Vui lòng đăng nhập để tiến hành mua hàng</p>
                                <div class="product-buttons mt-2 d-flex justify-content-center p-2">
                                    <a href="<?php echo $login;?>" class="btn btn-solid mb-1 btn-add-to-cart">Đăng Nhập</a>
                                </div>
                            </div>
                         </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
