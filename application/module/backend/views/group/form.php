<?php

$linkSaveClose	    = URL::createLink('backend', 'group', 'form', array('type' => 'save-close'));
$linkCancel	        = URL::createLink('backend', 'group', 'list');

$dataForm           = @$this->arrParam['form'];

$inputName          = Helper::cmsInput($type = 'text', $name = 'form[name]', $id = 'name', $value = @$dataForm['name'], $class = 'form-control', $size = null);
$inputToken		    = Helper::cmsInput($type = 'hidden', $name = 'form[token]', $id = 'token', $value = time());

$arrSelectStatus    = array('default' => '- Select Status -', 1 => 'Active', 0 => 'Inactive');
$selectStatus       = Helper::cmsSelectbox($name = 'form[status]', $class = 'custom-select', $arrSelectStatus, $keySelect = @$dataForm['status'], $style = null);

$arrSelectGroupACP  = array('default' => '- Select GroupACB -', 1 => 'Yes', 0 => 'No');
$selectGroupACP     = Helper::cmsSelectbox($name = 'form[group_acp]', $class = 'custom-select', $arrSelectGroupACP, $keySelect = @$dataForm['group_acp'], $style = null);

$rowName            = Helper::cmsRowForm($lblName = 'Name', $input = $inputName, $require = true);
$rowStatus          = Helper::cmsRowForm($lblName = 'Status', $input = $selectStatus, $require = true);
$rowGroupACP        = Helper::cmsRowForm($lblName = 'GroupACP', $input = $selectGroupACP, $require = true);

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
	$inputID          = Helper::cmsInput($type = 'hidden', $name = 'form[id]', $id = 'id', $value = @$dataForm['id'], $class = 'readonly', $size = null);
	$rowID            = Helper::cmsRowForm($lblName = 'ID', ": $strID" . $inputID);
}

$submitButton = Helper::cmsButtonSubmit($type = "submit", $class = "btn btn-success", $textOutfit = "Save");
$cancelUrl    = URL::createLink("backend", "user", "list");
$cancelButton = Helper::cmsButton($cancelUrl, $class = "btn btn-danger", $textOufit = "Cancel");
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<?= $showErrors; ?>
				<form action="#" method="get" name="group-list-form" id="group-list-form">

					<input type="hidden" name="module" value="backend">
					<input type="hidden" name="controller" value="group">
					<input type="hidden" name="action" value="form">
					<input type="hidden" name="type" value="save-close">

					<div class="card card-outline card-info">
						<div class="card-body">
							<div class="form-group">
								<?= $rowName; ?>
							</div>
							<div class="form-group">
								<?= $rowStatus; ?>
							</div>
							<div class="form-group">
								<?= $rowGroupACP; ?>
							</div>
							<div class="form-group">
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