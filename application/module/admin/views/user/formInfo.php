<?php

echo "<pre> THIS IS VIEW";
print_r($this);
echo "</pre?>";

$contentItem        = @$this->_item;

$showAllError       = '';
$success            = ''; 
$showError          = 'd-none';
if(isset($this->_error)){    
    $showAllError   = $this->_error;
    $showError      = '';
}

if(isset($this->success)){
    $success   = $this->success;
}

$commentImg         = 'Please accept a new image!';
if(!empty($contentItem['id'])){
    
    $titlePage      = "EDIT GROUP";
    $namegroup      = @$contentItem['name'];
    $oldImg         = @$contentItem['image'];
    $url            = @$contentItem['link'];
    ////////////////
    //$status         = @$contentItem['status'];
    ////////////////
    $ordering       = @$contentItem['ordering'];
    
    
    $urlImg        = $this->_urlImg . DS . $oldImg;
    $pathImg       = $this->_dirImg . DS . $oldImg;
    
    $xhtmlImg   = '
    <label class="font-weight-bold">Image</label>
    <div class="img"><img class="border border-info" src="' . $urlImg . '" alt="Girl in a jacket" width="100" height="80"></div>
    <br/>
    <span> - Name Image: </span>
    <span>' . $oldImg . '</span>
    <br/>
    <span> - Link Image:</span>
	<span>' . $pathImg . '</span>';
    $crud           = "edit";
    
}else{
    $titlePage      = "ADD GROUP";
    $xhtmlImg       = "";
    $crud           = "add";
}

$arrStatus     = array(2 => 'Select status', 0 => 'Inactive', 1 => 'Active');
$status        = @HTML::createSelectbox($arrStatus, 'status', $contentItem['status']);

?>
        
<form action="" method="post" name="add-form" enctype="multipart/form-data">
    <div class="card">
        <div class="card-header justify-content-between align-items-center">
            <h4 class="m-0"><?php echo $titlePage; ?></h4>
        </div>
        <div class="d-flex justify-content-between align-items-center">
        	<div class="pt-3 pl-5 pr-5 ml-2 mt-2">
                <?php
                    echo $showAllError;
                ?>
            </div>    
        </div>
        
        <div class="d-flex justify-content-between align-items-center successmsg">
        	<div class="pl-1">
                <?php
                    echo $success;
                ?>
            </div>    
        </div>      
        
        <div class="card-body">
            <div class="form-group">
                <label class="font-weight-bold">Name Group</label>
                <input class="form-control" type="text" name="name" value="<?php echo @$namegroup; ?>">
            </div>

            <div class="form-group">
                <?php
                  echo $xhtmlImg;
                ?>
            </div>

            <div class="form-group">
                <p style="color:red;"><?php echo $commentImg; ?></p>
                <input type="file" name="file-upload" />
                <p style="color:red;"></p>

            </div>


            <div class="form-group">
                <label class="font-weight-bold">Link</label>
                <input class="form-control" type="text" name="url" value="<?php echo @$url; ?>">
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Status</label>
                <br />
                <?php echo @$status; ?>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Ordering</label>
                <input class="form-control" type="text" name="ordering" value="<?php echo @$ordering; ?>">
            </div>
            <input class="form-control" type="hidden" name="crud" value="<?php echo $crud; ?>">
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="index.php?module=admin&controller=group&action=index" class="btn btn-danger">Cancel</a>
            <input class="form-control" type="hidden" name="token" value="<?php echo time(); ?>">
        </div>
    </div>
</form>
