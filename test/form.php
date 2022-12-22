<?php 
        echo "<pre>";
        print_r($this);
        echo "</pre>";
        
        $inputName  = Helper::cmsInput($type = 'text', $name = 'name',$id = null, $value = null, $class = 'form-control', $size = null);
        $rowName    = Helper::cmsRowForm($lblName = 'Name', $input = $inputName, $require = true);
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert"
						aria-hidden="true">×</button>
					<h5>
						<i class="icon fas fa-exclamation-triangle"></i> Lỗi!
					</h5>
					<ul class="list-unstyled mb-0">
						<li class="text-white"><b>Name:</b> Giá trị này không được rỗng!</li>
						<li class="text-white"><b>Group ACP:</b> Vui lòng chọn giá trị</li>
						<li class="text-white"><b>Status:</b> Vui lòng chọn giá trị!</li>
					</ul>
				</div>
				<form action="">
					<div class="card card-outline card-info">
						<div class="card-body">
							<div class="form-group">
<!-- 								<label>Name <span class="text-danger">*</span></label>  -->
<!-- 								<input type="text" class="form-control" name="name"> -->
								<?php 
								    echo $rowName;
							    ?>
							</div>
							<div class="form-group">
								<label>Group ACP <span class="text-danger">*</span></label> <select
									class="custom-select">
									<option selected>- Select Group ACP -</option>
									<option>Active</option>
									<option>Inactive</option>
								</select>
							</div>
							<div class="form-group">
								<label>Status <span class="text-danger">*</span></label> <select
									class="custom-select">
									<option selected>- Select Status -</option>
									<option>Active</option>
									<option>Inactive</option>
								</select>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-success">Save</button>
							<a href="group-list.php" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</div>