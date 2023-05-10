<?php
$arrBanner          = array('slider1.jpg','slider2.jpg','slider3.jpg');

$xhtmlBanner    = '';           
foreach ($arrBanner as $imgBanner){
    $urlBanner         = UPLOAD_URL . 'banner' . DS . $imgBanner;
    $strSpecial1       = '\\';
    $strSpecial2       = "/";
    $urlBanner         = str_replace($strSpecial1 ,$strSpecial2, $urlBanner);
    $xhtmlBanner      .= '<div>
                			<a href="" class="home text-center"> <img
                				src="'.$urlBanner.'" alt=""
                				class="bg-img blur-up lazyload">
                			</a>
                		</div>';
}

?>
<section class="p-0 my-home-slider">
	<div class="slide-1 home-slider">
		<?php 
		  echo $xhtmlBanner;
		?>
	</div>
</section>