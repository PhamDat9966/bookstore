<?php
$message = '';
switch ($this->arrParam['type']) {
    case 'register-success':
        $message = "Tài khoảng của bạn đã được tạo thành công!. Xin vui lòng chờ kích hoạt từ người quản trị.";
        break;
	case 'not-permission':
		$message = "Bạn không có quyền truy cập vào chức năng đó!.";
		break;	
	case 'not-url':
	    $message = "Đường dẫn không hợp lệ!.";
	    break;	
}

$mainPageLink   =   Helper::cmsButton(URL::createLink('frontend', 'user', 'index'), 'btn btn-solid', 'Quay về trang chủ');

?>

<div class="breadcrumb-section" style="margin-top: 50px;">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-title">
					<h2 class="py-2"><?php echo $message;?></h2>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="p-0">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="error-section">
					<?php echo $mainPageLink;?>
				</div>
			</div>
		</div>
	</div>
</section>
