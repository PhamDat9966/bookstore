<?php 
$logout_form        = '';
$backgroundImgURL   = 'public/template/admin/main/images/logout-bg.webp';
$logout_form = '
<section id="content" class="w-100">
    <div class="content-wrap py-0">
    
    <div class="section p-0 m-0 h-100 position-absolute"
        style="background: url('.$backgroundImgURL.') center center no-repeat; background-size: cover;">   
    </div>
    
        <div class="vertical-middle">
            <div class="container-fluid py-5 mx-auto">
                <div class="center">
                    <h2 class="text-white">ZendVN</h2>
                </div>

                <div class="card mx-auto rounded-0 border-0"
                    style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
                    <div class="card-body" style="padding: 40px;">
						
                        <h3>Bạn Đã Đăng Xuất Thành Công</h3>
                        Click vào <a href="index.php?module=admin&controller=user&action=login">đây</a> để về trang đăng nhập

                    </div>
                </div>
                <div class="text-center dark mt-3"><small>Copyrights &copy; All Rights Reserved by ZendVN
                        Inc.</small></div>
            </div>
        </div>


</section><!-- #content end -->
';
?>

    <!-- Document Wrapper
	============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Content
		============================================= -->
 		<?php echo $logout_form;?>

    </div><!-- #wrapper end -->
