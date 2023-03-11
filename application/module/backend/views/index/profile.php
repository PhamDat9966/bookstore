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
            $inputIDHidden    = Helper::cmsInput($type = 'hidden', $name = 'form[id]',$id = 'id', $value = @$dataForm['id'], $class = 'form-control', $size = null);
            $inputID          = Helper::cmsInput($type = 'text', $name = 'form[id]',$id = 'id', $value = @$dataForm['id'], $class = 'form-control', $size = null, $option = $idDis);
            $rowID            = Helper::cmsRowForm($lblName = 'ID', $input = $inputID, $require = $idRequire);
            
            $inputUsernameHidden      = Helper::cmsInput($type = 'hidden', $name = 'form[username]'  ,$id = 'username'   , $value = @$dataForm['username']   , $class = 'form-control', $size = null);
            $inputPasswordHidden      = Helper::cmsInput($type = 'hidden', $name = 'form[password]'  ,$id = 'password'   , $value = @$dataForm['password']   , $class = 'form-control', $size = null);
            $inputEmailHidden         = Helper::cmsInput($type = 'hidden', $name = 'form[email]'     ,$id = 'email'      , $value = @$dataForm['email']      , $class = 'form-control', $size = null);
            
            $idRequire           = false;
            $usernameRequire     = false;
            $emailRequire        = false;
            
            //$inputHiddenTask            = '<input type="hidden" name="task" value="'.$this->arrParam['task'].'">';
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
        $cancelUrl    = URL::createLink("backend", "user", "list");
        $cancelButton = Helper::cmsButton($cancelUrl, $class="btn btn-danger", $textOufit = "Cancel");
    
        
        $message = '';
        
        if(isset($_SESSION['message'])){
            $message = Helper::cmsMessage($_SESSION['message']);
        }
        //Session::delete('message');
        
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<?php 
            	   //require_once 'messageBox/index.php';
            	   echo $message;
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









