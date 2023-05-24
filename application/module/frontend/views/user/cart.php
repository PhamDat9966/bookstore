<?php
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

echo "<pre>";
print_r($this);
echo "</pre>";
$cartList = $this->arrParam['cartList'];
$cart     = $this->arrParam['cart'];

$xhtmlCart = '';
foreach ($cartList as $keyCart=>$valueCart){
    $id         = $valueCart['id'];
    $name       = $valueCart['name'];
    $picture    = UPLOAD_URL .'book' . DS . $valueCart['picture'];
    
    $quatity    = $cart['quatity'][$id];
    $price      = $cart['price'][$id];
    
    $totalPrice = $quatity * $price;
    
    $priceFormat = number_format($price);
    $totalPriceFormat = number_format($totalPrice);
    
    $xhtmlCart .= '<tr>
                        <td>
                            <a href="item.html"><img
                                    src="'.$picture.'"
                                    alt="'.$name.'"></a>
                        </td>
                        <td><a href="item.html">'.$name.'</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input type="number" name="quantity" value="'.$quatity.'" class="form-control input-number" id="quantity-10" min="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="td-color text-lowercase">'.$priceFormat.' đ</h2>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="td-color text-lowercase">
                                        <a href="#" class="icon"><i class="ti-close"></i></a>
                                    </h2>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h2 class="text-lowercase">'.$totalPriceFormat.' đ</h2>
                        </td>
                        <td>
                            <div class="qty-box">
                                <div class="input-group">
                                    <input type="number" name="quantity" value="1" class="form-control input-number" id="quantity-10" min="1">
                                </div>
                            </div>
                        </td>
                        <td><a href="#" class="icon"><i class="ti-close"></i></a></td>
                        <td>
                            <h2 class="td-color text-lowercase">48,300 đ</h2>
                        </td>
                    </tr>
                    <input type="hidden" name="form[book_id][]" value="10" id="input_book_id_10">
                    <input type="hidden" name="form[price][]" value="48300" id="input_price_10">
                    <input type="hidden" name="form[quantity][]" value="1" id="input_quantity_10">
                    <input type="hidden" name="form[name][]" value="Chờ Đến Mẫu Giáo Thì Đã Muộn" id="input_name_10"><input type="hidden" name="form[picture][]" value="product.jpg" id="input_picture_10">
                    ';
}


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
<form action="" method="POST" name="admin-form" id="admin-form">
    <section class="cart-section section-b-space">
        <div class="container">
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
                                    <h2 class="text-lowercase">96,320 đ</h2>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row cart-buttons">
                <div class="col-6"><a href="index.html" class="btn btn-solid">Tiếp tục mua sắm</a></div>
                <div class="col-6"><button type="submit" class="btn btn-solid">Đặt hàng</button></div>
            </div>
        </div>
    </section>
</form>
