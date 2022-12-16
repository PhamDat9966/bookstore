<?php
$message = '';

// if(isset($_SESSION['message'])){
//     if($_SESSION['message']['class'] == 'success'){
//         $message = '<div class="alert alert-success alert-dismissible">
//                         '.$_SESSION['message']['content'].'
//                     </div>';
//     }else if($_SESSION['message']['class'] == 'error'){
//         $message = '<div class="alert alert-danger alert-dismissible">
//                         '.$_SESSION['message']['content'].'
//                     </div>';
//     }
// }///
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