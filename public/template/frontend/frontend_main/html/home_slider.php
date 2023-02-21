<?php
	    $strSpecial1        = '\\';
		$strSpecial2        = "/";
		$imageURL          = str_replace($strSpecial1 ,$strSpecial2, $imageURL);
?>
<section class="p-0 my-home-slider">
	<div class="slide-1 home-slider">
		<div>
			<a href="" class="home text-center"> <img
				src="<?php echo $imageURL?>/slider.jpg" alt=""
				class="bg-img blur-up lazyload">
			</a>
		</div>

		<div>
			<a href="" class="home text-center"> <img
				src="<?php echo $this->_urlImg;?>/slider.jpg" alt=""
				class="bg-img blur-up lazyload">
			</a>
		</div>
	</div>
</section>