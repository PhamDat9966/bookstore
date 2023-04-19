<?php 
//CK Editor
$ckEditorScriptTop  = '';
$ckFinder           = '';
if($this->arrParam['controller'] == 'book'){
    $ckEditorScriptTop = '<script type= text/javascript src="'. PUBLIC_URL . 'ckeditor'. DS .'ckeditor.js'.'"></script>';
    $ckFinder          =  '<script type= text/javascript src="'. PUBLIC_URL . 'ckfinder'. DS .'ckfinder.js'.'"></script>';
}

?>

<?php echo $this->_metaHTTP;?>
<?php echo $this->_metaName;?>
<?php echo $this->_fontFile;?>
<?php echo $this->_pluginsCss;?>
<?php echo $this->_cssFile;?>

<?php echo $ckEditorScriptTop.$ckFinder;?>



<!-- <meta charset="utf-8"> -->
<!--   <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<!--   <title>Admin Control Panel</title> -->

<!--   <link rel="stylesheet" href="/mvc-multy-admin-template/public/template/admin/admin_template/fonts/font"> -->
<!--   <link rel="stylesheet" href="/mvc-multy-admin-template/public/template/admin/admin_template/plugins/fontawesome-free/css/all.min.css"> -->
<!--   <link rel="stylesheet" href="/mvc-multy-admin-template/public/template/admin/admin_template/css/ionicons.min.css"> -->
<!--   <link rel="stylesheet" href="/mvc-multy-admin-template/public/template/admin/admin_template/css/adminlte.min.css"> -->
<!--   <link rel="stylesheet" href="/mvc-multy-admin-template/public/template/admin/admin_template/css/my-style.css" /> -->