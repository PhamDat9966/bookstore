<?php
$cartList           = $this->Items;
$xhtmlCart          = '';
$totalAllPriceBook  = 0;

$linkBookList       = URL::createLink('frontend','book', 'list');
$linkSubmitForm     = URL::createLink('frontend','user', 'buy');

if(!empty($this->Items)){
    $totalAllPriceBook = 0;
    foreach ($cartList as $key=>$value){
        $id         = $value['id'];
        $name       = $value['name'];
        $picture    = UPLOAD_URL .'book' . DS . $value['picture'];
        
        $quatity            = $value['quantity'];
        $totalAllPriceBook += $value['totalprice'];
        $priceTotal         = number_format($value['totalprice']);
        $price              = number_format($value['price']);
        $linkBookdetail     = URL::createLink('frontend','book', 'detail',array('book_id'=>$id));
        
        $inputBookID        = Helper::cmsInput('hidden', 'form[book_id][]',$value['id'] ,'input_book_id_' . $value['id']);     
        $inputQuantity      = Helper::cmsInput('hidden', 'form[quantity][]',$value['quantity'] ,'input_quantity_' . $value['id']);  
        $inputPrice         = Helper::cmsInput('hidden', 'form[price][]',$value['price'] ,'input_price_' . $value['id']);  
        $inputName          = Helper::cmsInput('hidden', 'form[name][]',$value['name'] ,'input_name_' . $value['id']); 
        $inputPicture       = Helper::cmsInput('hidden', 'form[picture][]',$value['picture'] ,'input_picture_' . $value['id']); 
        
        $xhtmlCart .= '<tr id="order-'.$id.'">
                        <td>
                            <a href="item.html"><img
                                    src="'.$picture.'"
                                    alt="'.$name.'"></a>
                        </td>
                        <td><a href="'.$linkBookdetail.'">'.$name.'</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input type="number" name="quantity" value="'.$quatity.'" class="form-control input-number" id="quantity-10" min="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="td-color text-lowercase">'.$priceTotal.' đ</h2>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="td-color text-lowercase">
                                        <a href="#" class="icon"><i class="ti-close"></i></a>
                                    </h2>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h2 class="text-lowercase">'.$price.' đ</h2>
                        </td>
                        <td>
                            <div class="qty-box">
                                <div class="input-group">
                                    <input id="quantity-'.$id.'" type="number" name="'.$id.'" value="'.$quatity.'" class="form-control input-number" id="quantity-10" min="1">
                                </div>
                            </div>
                        </td>
                        <td><a onclick="deleteItemOrder('.$id.')" href="#" class="icon"><i class="ti-close"></i></a></td>
                        <td>
                            <h2 id="totalPrice-'.$id.'" class="td-color text-lowercase">'.$priceTotal.' đ</h2>
                        </td>
                    </tr>';
        
        $xhtmlCart .= $inputBookID;
        $xhtmlCart .= $inputQuantity;
        $xhtmlCart .= $inputPrice;
        $xhtmlCart .= $inputName;
        $xhtmlCart .= $inputPicture;
    }
    
    $submitButton = '$inputPicture';
    
}else {
    $nonCartSTR = '<h3>Không có sản phẩm nào trong giỏ hàng!</h3>';
}

// <input type="hidden" name="form[book_id][]" value="10" id="input_book_id_10">
// <input type="hidden" name="form[price][]" value="48300" id="input_price_10">
// <input type="hidden" name="form[quantity][]" value="1" id="input_quantity_10">
// <input type="hidden" name="form[name][]" value="Chờ Đến Mẫu Giáo Thì Đã Muộn" id="input_name_10"><input type="hidden" name="form[picture][]" value="product.jpg" id="input_picture_10">

?>
<!-- TITLE -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2">Giỏ hàng</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CART CONTENT -->
<form action="<?php echo $linkSubmitForm;?>" method="POST" name="cart-form" id="cart-form">
    <section class="cart-section section-b-space">
        <div class="container">
        	<?php
        	
        	   if(isset($nonCartSTR)){
        	       
        	?>
        		<div class="row">
        			<div class="col-sm-12">
            			<?php 
            			     echo $nonCartSTR;
            			?>
        			</div>
        		</div>	
        	<?php 
        	
        	   } else{
        	       
        	?>
        	
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table cart-table table-responsive-xs">
                            <thead>
                                <tr class="table-head">
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tên sách</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số Lượng</th>
                                    <th scope="col"></th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
    
    							<?php echo $xhtmlCart;?>
                                
                            </tbody>
    
                        </table>
                        <table class="table cart-table table-responsive-md">
                            <tfoot>
                                <tr>
                                    <td>Tổng :</td>
                                    <td>
                                        <h2 id="totalPriceAllItem" class="text-lowercase"><?php echo (isset($totalAllPriceBook))?number_format($totalAllPriceBook):'';?></h2>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
               
                <div class="row cart-buttons">
                    <div class="col-6"><a href="<?php echo $linkBookList;?>" class="btn btn-solid">Tiếp tục mua sắm</a></div>
                    <div class="col-6">
                    	<button type="submit" class="btn btn-solid">Đặt hàng</button>
                    </div>
                </div>
            
             <?php 
        	       }
             ?>
        </div>
    </section>
</form>
