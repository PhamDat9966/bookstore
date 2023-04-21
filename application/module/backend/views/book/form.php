<?php

//     echo "<pre>book view";
//     print_r($this);
//     echo "</pre>";

    $dataForm           = @$this->arrParam['form'];
    
    $disabled           = '';
    $passwordType       = 'text';
    $hiddenRowForm      = '';
    
    $inputIDHidden          = '';
    
    $statusStyle         = '';   
    $groupStyle          = '';
    
    $generatePassword    = '';
    $rowGeneratePassword = '';
    
    $idRequire           = false;
    $nameRequire         = true;
    $priceRequire        = true;
    $saleOffRequire      = true;
    $descriptionRequire  = true;
    $shortDescriptionRequire = true;
    
    $inputID    = '';
    $rowID      =   '';
    
    // IMAGES
    $inputPicture       = Helper::cmsInput($type = 'file'  , $name = 'picture', $value = @$dataForm['picture'], $id  = 'picture', $class = '', $size = NULL, $option = 'onchange="previewPicture()"');
    $pictureShow        = '<img id="imageShow" src="">';
    
    $inputPictureHidden = '';
    
    // Edit 
    if(isset($this->arrParam['form']['id'])){
        // disabled
        $idDis ='disabled';
        
        $idRequire           = false;
        $nameRequire         = false;
        $priceRequire        = false;
        $saleOffRequire      = false;
        $descriptionRequire  = false;
        $shortDescriptionRequire = false;
        
        $inputHiddenTask            = '<input type="hidden" name="task" value="'.$this->arrParam['task'].'">';
        
        $pathImage                = UPLOAD_URL .'category'. DS . $dataForm['picture'];
        $pictureShow              = '<img id="imageShow" src="'.$pathImage.'">';
        $inputPictureHidden       = Helper::cmsInput($type = 'hidden'  , $name = 'form[picture_hidden]', $value = @$dataForm['picture'], $id  = 'picture', $class = 'form-control', $size = null);
    }

    $linkSaveClose	    = URL::createLink('backend', 'book', 'form', array('type' => 'save-close'));
    $linkCancel	        = URL::createLink('backend', 'book', 'list');    

    $inputName          = Helper::cmsInput($type = 'text'       , $name = 'form[name]'  ,     $value = @$dataForm['name'], $id = 'name',    $class = 'form-control', $size = null);
    
    $inputShortDescription  ='<textarea name="form[shortDescription]" class="form-control" rows="12" placeholder="Enter ..." style="height: 120px;"></textarea>';
    $inputDescription       ='<textarea name="form[description]" class="form-control ckEditor" id="ckEditor" rows="12" placeholder="Enter ..."></textarea>';
    
    $inputPrice         = Helper::cmsInput($type = 'text'       , $name = 'form[price]'     , $value = @$dataForm['price']   , $id = 'price'   ,    $class = 'form-control', $size = null);
    $inputSaleOff       = Helper::cmsInput($type = 'text'       , $name = 'form[sale_off]'  , $value = @$dataForm['sale_off'], $id = 'fullname'   , $class = 'form-control', $size = null);
          
    $arrSelectStatus    = array('default'=>'- Select Status -', 1 => 'Active', 0 => 'Inactive');
    $selectStatus       = Helper::cmsSelectbox($name = 'form[status]', $class ='custom-select', $arrSelectStatus, $keySelect = @$dataForm['status'],$style = $statusStyle);
    
    $arrSelectSpecial   = array('default'=>'- Select Special -', 1 => 'Active', 0 => 'Inactive');
    $selectSpecial      = Helper::cmsSelectbox($name = 'form[special]', $class ='custom-select', $arrSelectSpecial, $keySelect = @$dataForm['special'],$style = $statusStyle);
    
    // CATEGORY
    $arrSelectCategory     = array();
    $temp                  = array('default'  => '- Select Category -');
    $arrSelectCategory     = $temp + $this->slbCategory;

    $selectCategory        = Helper::cmsSelectbox($name = 'form[category_id]', $class ='custom-select', $arrSelectCategory, $keySelect = @$dataForm['category_id'],$style = $groupStyle);
    
    // Row
    $rowName            = Helper::cmsRowForm($lblName = 'Bookname', $input = $inputName,        $require = $nameRequire);
    
    
    $rowShortDescription = Helper::cmsRowForm($lblName = 'Short Description', $input = $inputShortDescription, $require = $shortDescriptionRequire);
    $rowDescription      = Helper::cmsRowForm($lblName = 'Description', $input = $inputDescription, $require = $descriptionRequire);
    
    $rowPrice           = Helper::cmsRowForm($lblName = 'Price',    $input = $inputPrice,       $require = $priceRequire);
    $rowSaleOff         = Helper::cmsRowForm($lblName = 'Sale Off', $input = $inputSaleOff,     $require = $saleOffRequire);
    
    $rowStatus          = Helper::cmsRowForm($lblName = 'Status',   $input = $selectStatus,     $require = true,            $option = '');
    $rowSpecial         = Helper::cmsRowForm($lblName = 'Special',   $input = $selectSpecial,     $require = true,            $option = '');
    $rowCategory        = Helper::cmsRowForm($lblName = 'Category',    $input = $selectCategory,      $require = true,            $option = '');
    
    $rowPicture         = Helper::cmsRowFormPicture($lblName = 'Picture', $input = $inputPicture . $inputPictureHidden);
    
    
    $showErrors = '';
    if(!empty($this->errors)){
        $showErrors = '<div class="alert alert-danger alert-dismissible">
        					<button type="button" class="close" data-dismiss="alert"
        						aria-hidden="true">×</button>
        					<h5>
        						<i class="icon fas fa-exclamation-triangle"></i> Lỗi!
        					</h5>'.@$this->errors.'
			           </div>';
    }

    $submitButton = Helper::cmsButtonSubmit($type="submit",$class="btn btn-success" ,$textOutfit = "Save");
    $cancelUrl    = URL::createLink("backend", "book", "list");
    $cancelButton = Helper::cmsButton($cancelUrl, $class="btn btn-danger", $textOufit = "Cancel");
    
    $inputToken		    = Helper::cmsInput($type = 'hidden',$name = 'form[token]', $value = time(),$id = 'token');
    
    
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
			    <?= $showErrors;?>
				<form action="#" method="post" name="book-list-form" id="book-list-form"  enctype="multipart/form-data">
	
<!--             		<input type="hidden" name="module" value="backend"> -->
<!--                     <input type="hidden" name="controller" value="user"> -->
<!--                     <input type="hidden" name="action" value="form"> -->
                    <input type="hidden" name="type" value="save-close">
					<div class="card card-outline card-info">
						<div class="card-body">
							<div class="form-group">
								<?= $rowID.$inputIDHidden;?>
							</div>
						
							<div class="form-book">
								<?= $rowName;?>
							</div>
							<div class="form-book">
								<?= $rowShortDescription;?>
							</div>
							<div class="form-book">
								<?= $rowDescription;?>
							</div>
							<div class="form-book">
								<?= $rowPrice;?>
							</div>
							<div class="form-book">
								<?= $rowSaleOff;?>
							</div>
							<div class="form-book">
								<?= $rowStatus;?>
							</div>
							<div class="form-book">
								<?= $rowCategory;?>
							</div>
							
							<div class="form-book">
								<?= $rowPicture; ?>
							</div>
							<div class="form-book">
								<?= $pictureShow; ?>
							</div>
							
							<?= $inputToken;?>
						</div>
						<div class="card-footer">
							<?= $submitButton;?>
							<?= $cancelButton;?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</div>

<!-- CKEditor -->
<script>
    var editor = CKEDITOR.replace('ckEditor');
    CKFinder.setupCKEditor( editor, null, { type: 'Files', currentFolder: '/bookstore/public/ckfinder/' } );
    //CKFinder.setupCKEditor( editor, '/bookstore/public/ckfinder/');
</script>


