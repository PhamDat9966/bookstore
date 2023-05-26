<?php

$cart = Session::get('cart');

$imageURL = UPLOAD_URL.'cart.png';
$totalItems = 0;
if(!empty($cart)){
    $totalItems = array_sum($cart['quantity']);
    $totalPrice = array_sum($cart['price']); 
}

$cartLink  = URL::createLink('frontend', 'user', 'cart');

?>
<li class="onhover-div mobile-cart">
	<div>
		<a href="<?php echo $cartLink;?>" id="cart" class="position-relative"> <img
			src="<?php echo $imageURL;?>" class="img-fluid blur-up lazyload"
			alt="cart"> <i class="ti-shopping-cart"></i> 
			<span id="totalItemCart" class="badge badge-warning"><?php echo $totalItems;?></span>
		</a>
	</div>
</li>