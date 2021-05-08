<?php
session_start();
$con=mysqli_connect("localhost","root","","buildecom_db");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/material-suppliers/');
define('SITE_PATH','http://127.0.0.1/material-suppliers/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/productimg/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/productimg/');
?>
?>