<?php
    $titleProfile = $this->_title;
    $xhtml  = '';
    if(!empty($this->Items)){
        $tableHeader    = '<thead><tr class="table-head"><th scope="col">Hình ảnh</th><th scope="col">Tên sách</th>
                                <th scope="col">Giá</th><th scope="col">Số Lượng</th><th scope="col"></th>
                                <th scope="col">Thành tiền</th></tr>
                        </thead>';
        
        foreach ($this->Items as $key=>$value){
            $cartId         = $value['id'];
            $date           = date("H:i d/m/Y", strtotime($value['date']));
            
            $arrBookID      = json_decode($value['books']);
            $arrPrice       = json_decode($value['prices']);
            $arrQuatity     = json_decode($value['quantities']);
            $arrName        = json_decode($value['names']);
            $arrPicture     = json_decode($value['pictures']);
            
            $tableContent   = '';
            $totalPriceOrder  = 0;
            foreach ($arrBookID as $keyB=>$valueB){
                $name               = $arrName[$keyB];
                $price              = $arrPrice[$keyB];
                $quatity            = $arrQuatity[$keyB];
                $picture            = UPLOAD_URL .'book' . DS . $arrPicture[$keyB];
                $totalPriceBook     = $quatity*$arrPrice[$keyB];
                $totalPriceOrder   += $totalPriceBook;      
                $tableContent   .= '<tbody><tr>
                                        <td>
                                            <a href="item.html">
                                                <img src="'.$picture.'" alt="'.$name.'">
                                            </a>
                                        </td>
                                        <td>
                                        	<a href="item.html">'.$name.'</a>

                                        </td>
                                        <td>
                                            <h2 class="text-lowercase">'.number_format($price).'</h2>
                                        </td>
                        				<td>
                                            <h2 class="text-lowercase">'.$quatity.'</h2>
                                        </td>
                        
                                        <td><a href="#" class="icon"><i class="ti-line-double"></i></a></td>
                                        <td>
                                            <h2 class="text-lowercase">'.number_format($totalPriceBook).' đ</h2>
                                        </td>
                                    </tr></tbody>';
            }
            
            $xhtml .='<div class="col-sm-12">
                    	<div class="row justify-content-md-center">
                    		<h5 class="text-primary col-sm-12"> Mã đơn hàng: '.$cartId.' - Thời gian: '.$date.'</h5>
                    	</div>
                        <table class="table cart-table table-responsive-xs">
                            '.$tableHeader.$tableContent.'	
        
                        </table>
                        
                        <table class="table cart-table table-responsive-md">
                            <tfoot>
                                <tr>
                                    <td>Tổng :</td>
                                    <td>
                                        <h2 class="text-lowercase">'.number_format($totalPriceOrder).' đ</h2>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
        
                    </div>';
            
        }
    }else {
        $xhtml .= '<h3>Chưa có đơn hàng nào!</h3>';
    }
    
?>
<div class="breadcrumb-section" style="margin-top: 50px;">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-title">
					<h2 class="py-2"><?php echo $titleProfile;?></h2>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="cart-section section-b-space">
    <div class="container">
        <div class="row">
        	<!-- content order -->
        	<?php echo $xhtml;?>
            <!-- end order -->
            
            
        </div>
    </div>
</section>