<?php

require_once 'define.php';

function myAutoload($ClassName)
{
    include_once LIBRARY_PATH . "{$ClassName}.php";
}

spl_autoload_register('myAutoload');

$bootstrap = new Bootstrap();
$bootstrap->init();



















