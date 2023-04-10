<?php

$moduler     = $this->arrParam['module'];
$controller  = $this->arrParam['controller'];
$action      = 'list';

$listGroup = URL::createLink($moduler, $controller, $action); 

?>
<div class="col-12">
    <?php
        echo '<h3>' . __FILE__ . '</h3>';
    ?>
    <!-- END Search & Filter  -->
	<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5 class="text-center"><i class="icon fas fa-ban"></i> Không có kết quả lọc và tìm kiếm nào tại 'Filter and Search' khớp với yêu cầu!</h5>
    </div>
    <div class="d-flex justify-content-center">
    	<a href="<?php echo $listGroup;?>" class="btn btn-primary">Quay lại trang trước</a>
    </div>
		
</div>