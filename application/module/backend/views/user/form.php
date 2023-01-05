<?php
    echo "<pre>";
    print_r($this);
    echo "</pre>";

    $dataForm           = @$this->arrParam['form'];

    $disabled           = '';
    $passwordType       = 'text';
    $hiddenRowForm      = '';
    
    $inputIDHidden       = '';
    $inputUsernameHidden = '';
    $inputPasswordHidden = '';
    $inputEmailHidden    = '';   
    
    $statusStyle         = '';   
    $groupStyle          = '';
    
    $generatePassword    = '';
    $rowGeneratePassword = '';
    
    // Edit with ID and Generate Password
    if(isset($this->arrParam['form']['id'])){
        // disabled
        $idDis = $usernameDis = $passwordDis = $emailDis = 'disabled';
        
        // hiddenInput when disabled Row
        $passwordType   = 'hidden';
        $rowPasswordHidden  = 'hidden';
        $inputUsernameHidden      = Helper::cmsInput($type = 'hidden', $name = 'form[username]'  ,$id = 'username'   , $value = @$dataForm['username']   , $class = 'form-control', $size = null);
        $inputPasswordHidden      = Helper::cmsInput($type = 'hidden', $name = 'form[password]'  ,$id = 'password'   , $value = @$dataForm['password']   , $class = 'form-control', $size = null);
        $inputEmailHidden         = Helper::cmsInput($type = 'hidden', $name = 'form[email]'     ,$id = 'email'      , $value = @$dataForm['email']      , $class = 'form-control', $size = null);
        
        // GeneratePassword
        if(isset($this->arrParam['form']['task'])){
            if($this->arrParam['form']['task'] == 'generatepass'){
                $fullNameDis     = 'disabled';
                $rowStatusHidden = 'hidden';
                $rowGroupHidden  = 'hidden';
                $statusStyle     = 'display:none';   
                $groupStyle      = 'display:none';
                
                $urlButtonGeneratePassword  = URL::createLink('backend', 'user', 'form', array('id'=>$this->arrParam['form']['id'],'task'=>$this->arrParam['form']['task'],'generateAction'=>'true'));
                $buttonGeneratePassword     = Helper::cmsButton($url = $urlButtonGeneratePassword, $class = 'btn btn-info', $textOufit= '<i class="fas fa-sync-alt"></i> General'); 
                $generatePassword           = Helper::cmsInput($type = null, $name = 'form[password]'  ,$id = 'password'   , $value = @$dataForm['password']   , $class = 'form-control', $size = null, $option = null);
                $rowGeneratePassword        = Helper::cmsRowForm($lblName = 'Password', $input = $buttonGeneratePassword .$generatePassword,    $require = true, $option = $rowPasswordHidden);
            }
        }
    }
    
    $arrSelectGroup             = array();
    $arrSelectGroup['default']  = '- Select Group -';
    foreach ($this->groupNameData as $keyG=>$valueG){
        $arrSelectGroup[$valueG['id']] = $valueG['name'];
    }

    $linkSaveClose	    = URL::createLink('backend', 'user', 'form', array('type' => 'save-close'));
    $linkCancel	        = URL::createLink('backend', 'user', 'list');    

    $inputUsername      = Helper::cmsInput($type = 'text'       , $name = 'form[username]'  ,$id = 'username'   , $value = @$dataForm['username']   , $class = 'form-control', $size = null, $option = $usernameDis);
    $inputPassword      = Helper::cmsInput($type = $passwordType, $name = 'form[password]'  ,$id = 'password'   , $value = @$dataForm['password']   , $class = 'form-control', $size = null, $option = $passwordDis);
    $inputEmail         = Helper::cmsInput($type = 'text'       , $name = 'form[email]'     ,$id = 'email'      , $value = @$dataForm['email']      , $class = 'form-control', $size = null, $option = $emailDis);
    $inputFullname      = Helper::cmsInput($type = 'text'       , $name = 'form[fullname]'  ,$id = 'fullname'   , $value = @$dataForm['fullname']   , $class = 'form-control', $size = null, $option = $fullNameDis);
      
    $inputToken		    = Helper::cmsInput($type = 'hidden',$name = 'form[token]',$id = 'token', $value = time());
    
    $arrSelectStatus    = array('default'=>'- Select Status -', 1 => 'Active', 0 => 'Inactive');
    $selectStatus       = Helper::cmsSelectbox($name = 'form[status]', $class ='custom-select', $arrSelectStatus, $keySelect = @$dataForm['status'],$style = $statusStyle);
    
    $selectGroup        = Helper::cmsSelectbox($name = 'form[group_id]', $class ='custom-select', $arrSelectGroup, $keySelect = @$dataForm['group_id'],$style = $groupStyle);
    
    // Row
    $rowUsername        = Helper::cmsRowForm($lblName = 'Username', $input = $inputUsername,    $require = true);
    $rowPassword        = Helper::cmsRowForm($lblName = 'Password', $input = $inputPassword,    $require = true, $option = $rowPasswordHidden);
    $rowEmail           = Helper::cmsRowForm($lblName = 'Email',    $input = $inputEmail,       $require = true);
    $rowFullname        = Helper::cmsRowForm($lblName = 'Fullname', $input = $inputFullname,    $require = true);
    $rowStatus          = Helper::cmsRowForm($lblName = 'Status',   $input = $selectStatus,     $require = true, $option = $rowStatusHidden);
    $rowGroup           = Helper::cmsRowForm($lblName = 'Group',    $input = $selectGroup,      $require = true, $option = $rowGroupHidden);
    
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
        $inputIDHidden    = Helper::cmsInput($type = 'hidden', $name = 'form[id]',$id = 'id', $value = @$dataForm['id'], $class = 'form-control', $size = null); 
        $inputID          = Helper::cmsInput($type = 'text', $name = 'form[id]',$id = 'id', $value = @$dataForm['id'], $class = 'form-control', $size = null, $option = $idDis);
        $rowID            = Helper::cmsRowForm($lblName = 'ID', $input = $inputID, $require = true);
    }
    
    //$cacel = ;
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
								<?= $rowID.$inputIDHidden;?>
							</div>
						
							<div class="form-group">
								<?= $rowUsername.$inputUsernameHidden;?>
							</div>
							<div class="form-group">
								<?= $rowPassword.$inputPasswordHidden;?>
							</div>
							<div class="form-group">
								<?= $rowEmail.$inputEmailHidden;?>
							</div>
							<div class="form-group">
								<?= $rowFullname;?>
							</div>
							
							<div class="form-group">
								<?= $rowStatus;?>
							</div>
							<div class="form-group">
								<?= $rowGroup;?>
							</div>
							
							<div class="form-group">
								<?= $rowGeneratePassword;?>
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









