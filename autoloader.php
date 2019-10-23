<?php

    require('vendor/autoload.php');
    $ext=dirname(__FILE__);
    $ext=$ext."\Helpers\*.php";
    $ext=str_replace('\\', '/', $ext);

    foreach (glob($ext) as $filename)
    {
        include_once($filename);
    }
?>