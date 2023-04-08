<?php
$listGroup = URL::createLink('backend', 'group', 'list'); 
?>
<div class="col-12">
    <?php
        require_once 'messageBox/index.php';
    ?>
    <?php
        echo '<h3>' . __FILE__ . '</h3>';
    ?>
    <!-- END Search & Filter  -->
	<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-ban"></i> Không có kết quả tìm kiếm nào khớp với yêu cầu!</h5>
    </div>
    <div class="d-flex justify-content-center">
    	<a href="<?php echo $listGroup;?>" class="btn btn-primary">Quay lại trang trước</a>
    </div>
		
</div>