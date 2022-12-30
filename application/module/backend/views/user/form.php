<?php
        
    //echo '<h3>'. __METHOD__ . '</h3>';
//         $linkSaveClose	= URL::createLink('admin', 'group', 'form', array('type' => 'save-close'));
    //         $btnSaveClose	= Helper::cmsButton('Save & Close', 'toolbar-save', $linkSaveClose, 'icon-32-save', 'submit');
    $linkSaveClose	    = URL::createLink('backend', 'user', 'form', array('type' => 'save-close'));
    $linkCancel	        = URL::createLink('backend', 'user', 'list');
    //cmsButtonAtag($name, $id, $link, $icon, $type = 'new')
    //cmsButtonAtag($name,$class ,$id, $link, $icon, $type = 'new')
    //$btnSaveClose       = Helper::cmsButtonAtag($name = 'Save',$class = 'btn btn-success' ,$id = null, $link = $linkSaveClose, $icon = null, $type = 'new');    
    //$btnCancel          = Helper::cmsButtonAtag($name = 'Cancel',$class = 'btn btn-danger' ,$id = null, $link = $linkCancel, $icon = null, $type = 'new');
    
    $dataForm           = @$this->arrParam['form'];

    $inputUsername      = Helper::cmsInput($type = 'text', $name = 'form[username]',$id = 'username', $value = @$dataForm['username'], $class = 'form-control', $size = null);
    $inputPassword      = Helper::cmsInput($type = 'text', $name = 'form[password]',$id = 'password', $value = @$dataForm['password'], $class = 'form-control', $size = null);
    $inputEmail         = Helper::cmsInput($type = 'text', $name = 'form[email]',$id = 'email', $value = @$dataForm['email'], $class = 'form-control', $size = null);
    $inputFullname      = Helper::cmsInput($type = 'text', $name = 'form[fullname]',$id = 'fullname', $value = @$dataForm['fullname'], $class = 'form-control', $size = null);
    
    
    $inputToken		    = Helper::cmsInput($type = 'hidden',$name = 'form[token]',$id = 'token', $value = time());
    
    $arrSelectStatus    = array('default'=>'- Select Status -', 1 => 'Active', 0 => 'Inactive');
    $selectStatus       = Helper::cmsSelectbox($name = 'form[status]', $class ='custom-select', $arrSelectStatus, $keySelect = @$dataForm['status'],$style = null);
    
    $arrSelectGroupACP  = array('default'=>'- Select GroupACB -', 1 => 'Yes', 0 => 'No');
    $selectGroupACP     = Helper::cmsSelectbox($name = 'form[group_acp]', $class ='custom-select', $arrSelectGroupACP, $keySelect = @$dataForm['group_acp'],$style = null);
    
    $rowUsername        = Helper::cmsRowForm($lblName = 'Username', $input = $inputUsername, $require = true);
    $rowPassword        = Helper::cmsRowForm($lblName = 'Password', $input = $inputPassword, $require = true);
    $rowEmail           = Helper::cmsRowForm($lblName = 'Email', $input = $inputEmail, $require = true);
    $rowFullname        = Helper::cmsRowForm($lblName = 'Fullname', $input = $inputFullname, $require = true);
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
    
    $inputID    = '';
    $rowID      =   '';
    if(isset($this->arrParam['id'])){
        $strID            = $this->arrParam['id'];
        $inputID          = Helper::cmsInput($type = 'hidden', $name = 'form[id]',$id = 'id', $value = @$dataForm['id'], $class = 'readonly', $size = null);            
        $rowID            = Helper::cmsRowForm($lblName = 'ID', ": $strID".$inputID);
    }
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
			    <?= $showErrors;?>
				<form action="#" method="get" name="user-list-form" id="user-list-form">
	
            		<input type="hidden" name="module" value="backend">
                    <input type="hidden" name="controller" value="user">
                    <input type="hidden" name="action" value="form">
                    <input type="hidden" name="type" value="save-close">
				
					<div class="card card-outline card-info">
						<div class="card-body">
							<div class="form-group">
								<?= $rowUsername;?>
							</div>
							<div class="form-group">
								<?= $rowPassword;?>
							</div>
							<div class="form-group">
								<?= $rowEmail;?>
							</div>
							<div class="form-group">
								<?= $rowFullname;?>
							</div>
							
							<div class="form-group">
								<?= $rowStatus;?>
							</div>
							<div class="form-group">
								<?= $rowGroupACP;?>
							</div>
							<div class="form-group">
								<?= $rowID;?>
							</div>
							<?= $inputToken;?>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-success"  namne='type' value='saveAndClose'">Save</button>
							<a href="index.php?module=backend&controller=user&action=list" class="btn btn-danger">Cancel</a>
							<?php 
							     //echo $btnCancel;
							?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</div>









