<?php
    $selected = 'default';
    if(isset($this->arrParam['sort'])){
        $selected       = $this->arrParam['sort'];   
    }

    $arrSort        = array('default'=>'- Sắp xếp -','price_asc'=>'Giá tăng dần','price_desc'=>'Giá giảm dần','latest'=>'Mới nhất');
    $selectBoxSort  = Helper::cmsSelectboxFrontend('sort', $class = '', $arrSort , $selected , null, 'sort');
    
?>
<div class="product-page-filter">
	<form action="" id="sort-form" method="POST">
		<?php echo $selectBoxSort;?>
	</form>
</div>

<!-- <div class="product-page-filter"> -->
<!-- 	<form action="" id="sort-form" method="POST"> -->
<!-- 		<select id="sort" name="sort"> -->
<!-- 			<option value="default" selected>- Sắp xếp -</option> -->
<!-- 			<option value="price_asc">Giá tăng dần</option> -->
<!-- 			<option value="price_desc">Giá giảm dần</option> -->
<!-- 			<option value="latest">Mới nhất</option> -->
<!-- 		</select> -->
<!-- 	</form> -->
<!-- </div> -->
