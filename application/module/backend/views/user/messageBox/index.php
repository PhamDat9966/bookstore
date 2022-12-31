<?php
$message = '';

if(isset($_SESSION['message'])){
    $message = Helper::cmsMessage($_SESSION['message']);
}
Session::delete('message');

?>

<div class="col-12">
	<?php 
	   echo $message;
	?>
</div>