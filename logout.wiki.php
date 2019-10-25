<?php
include('config.wiki.php');
$google_client->revokeToken();
session_destroy();
header('location:index.wiki.php');
