<?php 
echo '<pre>';
print_r($this);
echo '</pre>';

$logout_button = '<a href="index.php?module=admin&controller=user&action=logout" class="btn btn-info m-0">Logout</a>'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $this->_metaHTTP;?>
	<?php echo $this->_metaName;?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
	
	<?php echo $this->_title;?>
	<?php echo $this->_cssFile;?>
	
</head>

<body style="background-color: #eee;">
		
		<?php 
		require_once MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
		?>
    
    <?php echo $this->_jsFile;?>
    
</body>

</html>