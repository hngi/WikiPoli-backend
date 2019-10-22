<?php
require_once('../autoloader.php');

use Helper\Database as DB;
use Helper\Jwt_client as jwt;

session_start();
session_unset();
session_destroy();

header('Location: login.php');
?>