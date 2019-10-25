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
    header("Access-Control-Allow-Headers: X-Requested-With");
    header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
    header('Content-Type: application/json');
?>