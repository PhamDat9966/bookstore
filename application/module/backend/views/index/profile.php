<?php
    $dataForm           = $this->arrParam['form'];

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
    
    $idRequire           = false;
    $usernameRequire     = true;
    $emailRequire        = true;
    $fullNameRequire     = true;
    
    $inputID    = '';
    $rowID      =   '';

    // Edit with ID and Generate Password
    if(isset($this->arrParam['form']['id'])){
            // disabled
            $idDis = $usernameDis = $passwordDis = $emailDis = 'disabled';
            
            // hiddenInput when disabled Row
            $passwordType             = 'hidden';
            $rowPasswordHidden        = 'hidden';
            
            $strID            = $this->arrParam['form']['id'];
            $inputIDHidden    = Helper::cmsInput($type = 'hidden', $name = 'form[id]',$value = @$dataForm['id'],$id = 'id', $class = 'form-control', $size = null);
            $inputID          = Helper::cmsInput($type = 'text', $name = 'form[id]',$value = @$dataForm['id'], $id = 'id', $class = 'form-control', $size = null, $option = $idDis);
            $rowID            = Helper::cmsRowForm($lblName = 'ID', $input = $inputID, $require = $idRequire);
            
            $inputUsernameHidden      = Helper::cmsInput($type = 'hidden', $name = 'form[username]'  , $value = @$dataForm['username'] , $id = 'username', $class = 'form-control', $size = null);
            $inputPasswordHidden      = Helper::cmsInput($type = 'hidden', $name = 'form[password]'  , $value = @$dataForm['password'] , $id = 'password', $class = 'form-control', $size = null);
            $inputEmailHidden         = Helper::cmsInput($type = 'hidden', $name = 'form[email]'     , $value = @$dataForm['email']    , $id = 'email'   , $class = 'form-control', $size = null);
            
            $idRequire           = false;
            $usernameRequire     = false;
            $emailRequire        = false;
            
            //$inputHiddenTask            = '<input type="hidden" name="task" value="'.$this->arrParam['task'].'">';
        }
    
        $linkSaveClose	    = URL::createLink('backend', 'user', 'form', array('type' => 'save-close'));
        $linkCancel	        = URL::createLink('backend', 'user', 'list');    
    
        $inputUsername      = Helper::cmsInput($type = 'text'       , $name = 'form[username]'  , $value = @$dataForm['username']   , $id = 'username'   , $class = 'form-control', $size = null, $option = @$usernameDis);
        $inputPassword      = Helper::cmsInput($type = $passwordType, $name = 'form[password]'  , $value = @$dataForm['password']   , $id = 'password'   , $class = 'form-control', $size = null, $option = @$passwordDis);
        $inputEmail         = Helper::cmsInput($type = 'text'       , $name = 'form[email]'     , $value = @$dataForm['email']      , $id = 'email'      , $class = 'form-control', $size = null, $option = @$emailDis);
        $inputFullname      = Helper::cmsInput($type = 'text'       , $name = 'form[fullname]'  , $value = @$dataForm['fullname']   , $id = 'fullname'   , $class = 'form-control', $size = null, $option = @$fullNameDis);
          
        $inputToken		    = Helper::cmsInput($type = 'hidden',$name = 'form[token]', $value = time(), $id = 'token');
        
        $arrSelectStatus    = array('default'=>'- Select Status -', 1 => 'Active', 0 => 'Inactive');
        $selectStatus       = Helper::cmsSelectbox($name = 'form[status]', $class ='custom-select', $arrSelectStatus, $keySelect = @$dataForm['status'],$style = $statusStyle);
                
        // Row
        $rowUsername        = Helper::cmsRowForm($lblName = 'Username', $input = $inputUsername,    $require = $usernameRequire);
        $rowPassword        = Helper::cmsRowForm($lblName = 'Password', $input = $inputPassword,    $require = true,            $option = @$rowPasswordHidden);
        $rowEmail           = Helper::cmsRowForm($lblName = 'Email',    $input = $inputEmail,       $require = $emailRequire);
        $rowFullname        = Helper::cmsRowForm($lblName = 'Fullname', $input = $inputFullname,    $require = $fullNameRequire);
        
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
        $cancelUrl    = URL::createLink("backend", "index", "index");
        $cancelButton = Helper::cmsButton($cancelUrl, $class="btn btn-danger", $textOufit = "Cancel");
    
        
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<?php 
            	   require_once 'messageBoxProfile/index.php';
            	?>
			    <?= $showErrors;?>
				<form action="#" method="get" name="user-list-form" id="user-list-form">
	
            		<input type="hidden" name="module" value="backend">
                    <input type="hidden" name="controller" value="index">
                    <input type="hidden" name="action" value="profile">
                    <input type="hidden" name="type" value="save">
					<div class="card card-outline card-info">
						<div class="card-body">
							<div class="form-group">
								<?= $rowID.$inputIDHidden;?>
							</div>
						
							<div class="form-group">
								<?= $rowUsername.$inputUsernameHidden;?>
							</div>
							<div class="form-group">
								<?= $rowEmail.$inputEmailHidden;?>
							</div>
							<div class="form-group">
								<?= $rowFullname.$inputFullNameHidden;?>
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









