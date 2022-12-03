<?php 

echo "<pre>";
print_r($this);
echo "</pre>";

?>
<body class="stretched overlay-menu">
<?php
require_once TEMPLATE_PATH . 'admin' . DS . 'main' . DS . 'showCase' . DS . 'function.php';
$link = $this->_link;
$xhtmlVE   = getContent($link);
?>

<head>
	

	<?php echo $this->_metaHTTP;?>
	<?php echo $this->_metaName;?>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700&display=swap" rel="stylesheet"
    type="text/css" />
    
	<?php echo $this->_title;?>
	<?php echo $this->_cssFile;?>

</head>
<body>
    <!-- Content -->
    <div id="wrapper" class="clearfix bg-light">
        <header id="header" class="full-header dark">
            <div id="header-wrap">
                <div class="container">
                    <div class="header-row">
    
                        <!-- Logo -->
                        <div id="logo">
                            <a href="#" class="standard-logo"><span class="p-1">ZendVN</span></a>
                            <a href="#" class="retina-logo"><span class="p-1">ZendVN</span></a>
                        </div>
                        <!-- #logo end -->
    
                        <div>
                            <a href="#" class="button button-3d">Admin Panel</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-wrap-clone" style="height: 62px"></div>
        </header>
        <div class="container-fluid">
            <div class="row">
                <!-- Content -->
                <section id="content" class="bg-light">
                    <div class="content-wrap pt-lg-0 pt-xl-0 pb-0">
                        <div class="container-fluid clearfix">
                            <div class="heading-block border-bottom-0 center pt-4 mb-3">
                                <h3>Tin tức</h3>
                            </div>
                            <!-- Posts -->
                            <div class="row grid-container infinity-wrapper clearfix align-align-items-start">
                                <?php
                                echo $xhtmlVE;
                                ?>
                            </div>
    
                            <!-- Pagination -->
                            <div id="pagination" class="row">
                                <div class="center">
                                    <?php
                                    ?>
                                </div>
                            </div>
    
                        </div>
    
                    </div>
                </section> <!-- #content end -->
    
                <section class="right-side mb-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="box mt-4">
                                    <h3 class="mb-1">Giá vàng</h3>
    
                                    <div class="card card-body" id="box-gold">
                                        <!-- Waiting img-->
                                        <div id="waiting_gold" class="loader center"></div>
    
                                    </div>
                                </div>
                                <div class="box mt-4">
    
                                    <h3 class="mb-1">Giá coin</h3>
                                    <div class="card card-body" id="box-coin">
                                        <!-- Waiting  img-->
                                        <div id="waiting_coin" class="loader center"></div>
                                    </div>
    
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    
        <footer>
            <div id="copyrights" class="bg-dark dark">
                <div class="container clearfix">
    
                    <div class="row col-mb-30">
                        <div class="col-12 text-center text-muted">
                            Copyrights &copy; 2020 All Rights Reserved by ZendVN<br>
                        </div>
                    </div>
    
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up rounded-circle"></div>
<!--     <script src="js/jquery.js"></script> -->
<!--     <script src="js/plugins.min.js"></script> -->
<!--     <script src="js/functions.js"></script> -->
	<?php echo $this->_jsFile;?>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#box-gold').load("public/template/admin/main/showCase/get-gold.php");
            $('#box-coin').load("public/template/admin/main/showCase/get-coin.php");
        });
    </script>

</body>