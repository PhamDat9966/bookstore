<?php

require_once 'define.php';

function myAutoload($ClassName)
{
    include_once LIBRARY_PATH . "{$ClassName}.php";
}

spl_autoload_register('myAutoload');

Session::ini();

$bootstrap = new Bootstrap();
$bootstrap->init();

// echo "<pre>";
// print_r($bootstrap);
// echo "</pre>";



















