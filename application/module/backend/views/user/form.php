<?php
    $dataForm           = @$this->arrParam['form'];

    $disabled           = '';
    $passwordType       = 'text';
    $hiddenRowForm      = '';
    
    $inputIDHidden          = '';
    $inputUsernameHidden    = '';
    $inputPasswordHidden    = '';
    $inputEmailHidden       = '';   
    $inputFullNameHidden    = '';  
    
    $statusStyle         = '';   
    $groupStyle          = '';
    
    $generatePassword    = '';
    $rowGeneratePassword = '';
    
    $idRequire           = true;
    $usernameRequire     = true;
    $emailRequire        = true;
    $fullNameRequire     = true;
    
    $inputID    = '';
    $rowID      =   '';
    
    $inputHiddenTask     = ''; // For Generalpassword on case Password Empty
    // Edit with ID and Generate Password
    if(isset($this->arrParam['form']['id'])){
        // disabled
        $idDis = $usernameDis = $passwordDis = $emailDis = 'disabled';
        
        // hiddenInput when disabled Row
        $passwordType             = 'hidden';
        $rowPasswordHidden        = 'hidden';
        
        $strID            = $this->arrParam['form']['id'];
        $inputIDHidden    = Helper::cmsInput($type = 'hidden', $name = 'form[id]',$id = 'id', $value = @$dataForm['id'], $class = 'form-control', $size = null);
        $inputID          = Helper::cmsInput($type = 'text', $name = 'form[id]',$id = 'id', $value = @$dataForm['id'], $class = 'form-control', $size = null, $option = $idDis);
        $rowID            = Helper::cmsRowForm($lblName = 'ID', $input = $inputID, $require = $idRequire);
        
        $inputUsernameHidden      = Helper::cmsInput($type = 'hidden', $name = 'form[username]'  ,$id = 'username'   , $value = @$dataForm['username']   , $class = 'form-control', $size = null);
        $inputUsernameHidden      = Helper::cmsInput($type = 'hidden', $name = 'form[username]'  ,$id = 'username'   , $value = @$dataForm['username']   , $class = 'form-control', $size = null);
        $inputPasswordHidden      = Helper::cmsInput($type = 'hidden', $name = 'form[password]'  ,$id = 'password'   , $value = @$dataForm['password']   , $class = 'form-control', $size = null);
        $inputEmailHidden         = Helper::cmsInput($type = 'hidden', $name = 'form[email]'     ,$id = 'email'      , $value = @$dataForm['email']      , $class = 'form-control', $size = null);
        
        $idRequire           = false;
        $usernameRequire     = false;
        $emailRequire        = false;
        
        // GeneratePassword
        if(isset($this->arrParam['task'])){
            if($this->arrParam['task'] == 'generatepass'){
                $fullNameDis     = 'disabled';
                $rowStatusHidden = 'hidden';
                $rowGroupHidden  = 'hidden';
                $statusStyle     = 'display:none';   
                $groupStyle      = 'display:none';
                $fullNameRequire = false;
                
                $inputFullNameHidden        = Helper::cmsInput($type = 'hidden', $name = 'form[fullname]', $id = 'fullname', $value = @$dataForm['fullname'] , $class = 'form-control', $size = null);
                
                $urlButtonGeneratePassword  = URL::createLink('backend', 'user', 'form', array('id'=>$this->arrParam['form']['id'],'task'=>$this->arrParam['task'],'generateAction'=>'true'));
                $buttonGeneratePassword     = "<div class='col-2'>".Helper::cmsButton($url = $urlButtonGeneratePassword, $class = 'btn btn-info d-block', $textOufit= '<i class="fas fa-sync-alt"></i> General')."</div>"; 
                $generatePassword           = "<div class='col-10'>".Helper::cmsInput($type = null, $name = 'form[password]'  ,$id = 'password'   , $value = @$dataForm['password']   , $class = 'form-control', $size = null, $option = null)."</div>";
                $lblGeneratePassword        = "<div class='row'>".$buttonGeneratePassword .$generatePassword."</div>";
                
                $rowGeneratePassword        = Helper::cmsRowForm($lblName = 'Password', $input = $lblGeneratePassword,    $require = false, $option = 'class="d-block"');
                
                //task Hidden for Form
                $inputHiddenTask            = '<input type="hidden" name="task" value="'.$this->arrParam['task'].'">';
                
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

    $inputUsername      = Helper::cmsInput($type = 'text'       , $name = 'form[username]'  ,$id = 'username'   , $value = @$dataForm['username']   , $class = 'form-control', $size = null, $option = @$usernameDis);
    $inputPassword      = Helper::cmsInput($type = $passwordType, $name = 'form[password]'  ,$id = 'password'   , $value = @$dataForm['password']   , $class = 'form-control', $size = null, $option = @$passwordDis);
    $inputEmail         = Helper::cmsInput($type = 'text'       , $name = 'form[email]'     ,$id = 'email'      , $value = @$dataForm['email']      , $class = 'form-control', $size = null, $option = @$emailDis);
    $inputFullname      = Helper::cmsInput($type = 'text'       , $name = 'form[fullname]'  ,$id = 'fullname'   , $value = @$dataForm['fullname']   , $class = 'form-control', $size = null, $option = @$fullNameDis);
      
    $inputToken		    = Helper::cmsInput($type = 'hidden',$name = 'form[token]',$id = 'token', $value = time());
    
    $arrSelectStatus    = array('default'=>'- Select Status -', 1 => 'Active', 0 => 'Inactive');
    $selectStatus       = Helper::cmsSelectbox($name = 'form[status]', $class ='custom-select', $arrSelectStatus, $keySelect = @$dataForm['status'],$style = $statusStyle);
    
    $selectGroup        = Helper::cmsSelectbox($name = 'form[group_id]', $class ='custom-select', $arrSelectGroup, $keySelect = @$dataForm['group_id'],$style = $groupStyle);
    
    // Row
    $rowUsername        = Helper::cmsRowForm($lblName = 'Username', $input = $inputUsername,    $require = $usernameRequire);
    $rowPassword        = Helper::cmsRowForm($lblName = 'Password', $input = $inputPassword,    $require = true,            $option = @$rowPasswordHidden);
    $rowEmail           = Helper::cmsRowForm($lblName = 'Email',    $input = $inputEmail,       $require = $emailRequire);
    $rowFullname        = Helper::cmsRowForm($lblName = 'Fullname', $input = $inputFullname,    $require = $fullNameRequire);
    $rowStatus          = Helper::cmsRowForm($lblName = 'Status',   $input = $selectStatus,     $require = true,            $option = @$rowStatusHidden);
    $rowGroup           = Helper::cmsRowForm($lblName = 'Group',    $input = $selectGroup,      $require = true,            $option = @$rowGroupHidden);
    
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
    
//     $inputID    = '';
//     $rowID      =   '';
//     if(isset($this->arrParam['id'])){
//         $strID            = $this->arrParam['id'];
//         $inputIDHidden    = Helper::cmsInput($type = 'hidden', $name = 'form[id]',$id = 'id', $value = @$dataForm['id'], $class = 'form-control', $size = null); 
//         $inputID          = Helper::cmsInput($type = 'text', $name = 'form[id]',$id = 'id', $value = @$dataForm['id'], $class = 'form-control', $size = null, $option = $idDis);
//         $rowID            = Helper::cmsRowForm($lblName = 'ID', $input = $inputID, $require = $idRequire);
//     }
    
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
					<?php echo $inputHiddenTask;?>
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
								<?= $rowFullname.$inputFullNameHidden;?>
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









