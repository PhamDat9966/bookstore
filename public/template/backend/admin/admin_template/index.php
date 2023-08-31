<!DOCTYPE html>
<html lang="en">

<head>
	<?php 
	   include_once 'html/header.php';
	?>  
</head>

<!-- <body class="hold-transition sidebar-mini layout-fixed"> -->
<body class="hold-transition sidebar-mini">
    <!-- WRAPPER -->
    <div class="wrapper">
    
    	<!-- NAVBAR -->
    		<?php 
    		      include_once BLOCK_PATH . 'navbar-backend.php';
    		?>
    	<!-- END NAVBAR -->
    	
    	<!-- MAIN-SIDEBAR -->
    		<?php 
    		      include_once 'html/main-sidebar.php';
    		?>
    	<!-- END MAIN-SIDEBAR -->
    	
	   <!-- CONTENT WRAPPER -->
		<div class="content-wrapper">

			<?php include_once 'html/page-header.php';?>
			
			<!--MAIN CONTENT -->
			<div class="container-fluid">
        		<?php 
        		      require_once MODULE_PATH . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
         		?>
			</div>
		</div>		
       <!-- END WRAPPER -->
	       

	</div><!-- END WRAPPER -->
	<!-- FOOTER -->
    <?php include_once 'html/footer.php';?>
    <!-- END FOOTER -->
	<!-- SCRIPT -->
		<?php include_once 'html/script.php';?>
	<!-- END SCRIPT -->
	
</body>
</html>


















