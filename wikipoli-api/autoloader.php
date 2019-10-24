<?php
    
    require('vendor/autoload.php');
    $ext=dirname(__FILE__);
    $ext=$ext."\Helpers\*.php";
    $ext=str_replace('\\', '/', $ext);
    
    foreach (glob($ext) as $filename)
    {
        include_once($filename);
    }

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Method: *");
        header('Content-Type: application/json');
?>