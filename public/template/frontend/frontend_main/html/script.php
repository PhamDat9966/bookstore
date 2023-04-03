<?php 
    $jsFile = $this->_jsFile;
    
    $strSpecial1 = '\\';
    $strSpecial2 = "/";
    $jsFile      = str_replace($strSpecial1 ,$strSpecial2, $jsFile);
    $jsFile      = str_replace('type="text/javascript"', "", $jsFile);
    echo $jsFile;
?>
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/jquery-3.3.1.min.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/jquery-ui.min.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/jquery.exitintent.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/notifyjs/notify.min.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/exit.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/menu.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/lazysizes.min.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/popper.min.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/slick.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/bootstrap.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/bootstrap-notify.min.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/script.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/my-custom.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/search.js"></script> -->
<!-- <script src="/bookstore/public/template/frontend/frontend_main/js/custom.js"></script> -->