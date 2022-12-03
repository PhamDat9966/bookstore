<?php 
    echo "<pre>";
    print_r($this);
    echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $this->_metaHTTP;?>
	<?php echo $this->_metaName;?>
	<?php echo $this->_title;?>
	<?php echo $this->_cssFile;?>
	
</head>

<body style="background-color: #eee;">
    <div class="container pt-5">
        <?php 
        require_once MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
        ?>
    </div>

    <?php echo $this->_jsFile;?>
</body>

</html>