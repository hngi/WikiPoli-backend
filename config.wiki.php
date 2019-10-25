<?php
//config.php
require_once "vendor/autoload.php";
$google_client = new Google_Client();
$google_client->setClientId('308702191139-jr6ead14d7sviot7p7si3l41q8o6k6cb.apps.googleusercontent.com');
$google_client->setClientSecret('u84DU3SBT6iUri8h-cZi7Nzj');
$google_client->setRedirectUri('http://localhost:8080/wiki-poli/index.wiki.php');
$google_client->addScope('email');
$google_client->addScope('profile');
session_start();