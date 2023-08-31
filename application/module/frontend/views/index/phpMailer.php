<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once LIBRARY_PATH . 'phpMailer/vendor/autoload.php';

$mail = new PHPMailer(true);

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

if(isset($this->arrParam['form'])){
    $dataUserRegister = $this->arrParam['form'];
}

$linkActive       = URL::createLink('frontend', 'index', 'activeAccount');

try {
    
    $mail->isSMTP();
    $mail->Host       = 'ssl://smtp.gmail.com:465';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'phamdat99996666@gmail.com';
    $mail->Password   = 'iiwiqdvsiroltrvd';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = '587';
    $mail->CharSet    = 'UTF-8';
    
    //Recipients
    $mail->setFrom('phamdat99996666@gmail.com', 'PHPMailer test');
    $mail->addAddress($dataUserRegister['email']);
    
    //Content
    $mail->isHTML(true);
    $mail->Subject = 'ZendVN - Xác nhận thông tin tài khoảng';
    $mail->Body    = '
        <ul>
            <li>Tên : ' . $dataUserRegister['fullname'] . '</li>
            <li>Email : ' . $dataUserRegister['email'] . '</li>
            <li>Tiêu đề : ' . 'Xác nhận tài khoản' . '</li>
            <li>Nội dung : ' . 'Sử dụng đường link này đây để này xác nhận tài khoảng: '.'localhost'.$linkActive.'</li>
        </ul>';
    
    $mail->send();
    $message =  '<p class="alert text-primary">Việc đăng ký đã thành công. Mời bạn kiểm tra gmail để xác nhận tài khoảng!</p>';
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $message =  '<p class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại!</p>';
}

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








