<?php 
        //echo '<h3>'. __METHOD__ . '</h3>';
//         $linkSaveClose	= URL::createLink('admin', 'group', 'form', array('type' => 'save-close'));
//         $btnSaveClose	= Helper::cmsButton('Save & Close', 'toolbar-save', $linkSaveClose, 'icon-32-save', 'submit');
        $linkSaveClose	    = URL::createLink('backend', 'group', 'form', array('type' => 'save-close'));
                            //cmsButtonAtag($name, $id, $link, $icon, $type = 'new')
        $btnSaveClose       = Helper::cmsButtonAtag($name = 'Save',$class = 'btn btn-success"' ,$id = null, $link = $linkSaveClose, $icon = null, $type = 'submit');    
        
        $dataForm           = @$this->arrParam['form'];
        $inputName          = Helper::cmsInput($type = 'text', $name = 'form[name]',$id = 'name', $value = @$dataForm['name'], $class = 'form-control', $size = null);
        $inputToken		    = Helper::cmsInput($type = 'hidden',$name = 'form[token]',$id = 'token', $value = time());
        
        $arrSelectStatus    = array('default'=>'- Select Status -', 1 => 'Active', 0 => 'Inactive');
        $selectStatus       = Helper::cmsSelectbox($name = 'form[status]', $class ='custom-select', $arrSelectStatus, $keySelect = @$dataForm['status'],$style = null);
        
        $arrSelectGroupACP  = array('default'=>'- Select GroupACB -', 1 => 'Yes', 0 => 'No');
        $selectGroupACP     = Helper::cmsSelectbox($name = 'form[group_acp]', $class ='custom-select', $arrSelectGroupACP, $keySelect = @$dataForm['group_acp'],$style = null);
        
        $rowName            = Helper::cmsRowForm($lblName = 'Name', $input = $inputName, $require = true);
        $rowStatus          = Helper::cmsRowForm($lblName = 'Status', $input = $selectStatus, $require = true);
        $rowGroupACP        = Helper::cmsRowForm($lblName = 'GroupACP', $input = $selectGroupACP, $require = true);
        
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
      
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
			    <?= $showErrors;?>
				<form action="#" method="get" name="group-list-form" id="group-list-form">
	
            		<input type="hidden" name="module" value="backend">
                    <input type="hidden" name="controller" value="group">
                    <input type="hidden" name="action" value="form">
                    <input type="hidden" name="type" value="save-close">
				
					<div class="card card-outline card-info">
						<div class="card-body">
							<div class="form-group">
								<?= $rowName;?>
							</div>
							<div class="form-group">
								<?= $rowStatus;?>
							</div>
							<div class="form-group">
								<?= $rowGroupACP;?>
							</div>
							<?= $inputToken;?>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-success"  namne='type' value='saveAndClose'">Save</button>
							<a href="group-list.php" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</div>









