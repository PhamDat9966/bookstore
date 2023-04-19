<?php
echo "<pre>view";
print_r($this);
echo "</pre>";

$linkSaveClose	    = URL::createLink('backend', 'category', 'form', array('type' => 'save-close'));
$linkCancel	        = URL::createLink('backend', 'category', 'list');

$dataForm           = @$this->arrParam['form'];

$inputName          = Helper::cmsInput($type = 'text'  , $name = 'form[name]', $value = @$dataForm['name'], $id  = 'name', $class = 'form-control', $size = null);
$inputToken		    = Helper::cmsInput($type = 'hidden', $name = 'form[token]', $value = time(), $id  = 'token');

//Picture
$inputPicture       = Helper::cmsInput($type = 'file'  , $name = 'picture', $value = @$dataForm['picture'], $id  = 'picture', $class = '', $size = NULL, $option = 'onchange="previewPicture()"');
$pictureShow        = '<img id="imageShow" src="">';

$arrSelectStatus    = array('default' => '- Select Status -', 1 => 'Active', 0 => 'Inactive');
$selectStatus       = Helper::cmsSelectbox($name = 'form[status]', $class = 'custom-select', $arrSelectStatus, $keySelect = @$dataForm['status'], $style = null);

$rowNameOutput      = '';
$inputNameHidden    = '';

$rowName            = Helper::cmsRowForm($lblName = 'Name', $input = $inputName, $require = true);
$rowStatus          = Helper::cmsRowForm($lblName = 'Status', $input = $selectStatus, $require = true);

$inputPictureHidden = '';
if($this->task == 'edit'){

    $inputName      = Helper::cmsInput($type = 'text', $name = 'form[name]', $value = @$dataForm['name'], $id = 'name', $class = 'form-control', $size = null);
    $rowName        = Helper::cmsRowForm($lblName = 'Name', $input = $inputName, $require = false);
    $rowStatus      = Helper::cmsRowForm($lblName = 'Status', $input = $selectStatus, $require = false);
    
    $pathImage                = UPLOAD_URL .'category'. DS . $dataForm['picture'];
    $pictureShow              = '<img id="imageShow" src="'.$pathImage.'">';
    $inputPictureHidden       = Helper::cmsInput($type = 'hidden'  , $name = 'form[picture_hidden]', $value = @$dataForm['picture'], $id  = 'picture', $class = 'form-control', $size = null);

}

$rowNameOutput  = $rowName . $inputNameHidden;

$rowPicture         = Helper::cmsRowFormPicture($lblName = 'Picture', $input = $inputPicture . $inputPictureHidden);

$showErrors = '';
if (!empty($this->errors)) {
	$showErrors = '<div class="alert alert-danger alert-dismissible">
            					<button type="button" class="close" data-dismiss="alert"
            						aria-hidden="true">×</button>
            					<h5>
            						<i class="icon fas fa-exclamation-triangle"></i> Lỗi!
            					</h5>' . @$this->errors . '
				           </div>';
}

$inputID    = '';
$rowID      =   '';
if (isset($this->arrParam['id'])) {
	$strID            = $this->arrParam['id'];
	$inputID          = Helper::cmsInput($type = 'hidden', $name = 'form[id]', $value = @$dataForm['id'], $id = 'id', $class = 'readonly', $size = null);
	$rowID            = Helper::cmsRowForm($lblName = 'ID', ": $strID" . $inputID);
}

$submitButton = Helper::cmsButtonSubmit($type = "submit", $class = "btn btn-success", $textOutfit = "Save");
$cancelUrl    = URL::createLink("backend", "category", "list");
$cancelButton = Helper::cmsButton($cancelUrl, $class = "btn btn-danger", $textOufit = "Cancel");

?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<?= $showErrors; ?>
				<form action="#" method="post" name="category-list-form" id="category-list-form" enctype="multipart/form-data">
					<?php 
					   /* IF USE METHOD GET */
					   //echo $inputModel.$inputController,$inputAction;
					?>
					
					<input type="hidden" name="type" value="save-close">

					<div class="card card-outline card-info">
						<div class="card-body">
							<div class="form-category">
								<?= $rowNameOutput; ?>
							</div>
							<div class="form-category">
								<?= $rowStatus; ?>
							</div>
							<div class="form-category">
								<?= $rowPicture; ?>
							</div>
							<div class="form-category">
								<?= $pictureShow; ?>
							</div>
							<div class="form-category">
								<?= $rowID; ?>
							</div>
							<?= $inputToken; ?>
						</div>
						<div class="card-footer">
							<?= $submitButton; ?>
							<?= $cancelButton; ?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</div>