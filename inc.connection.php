<?php
session_start();
$con=mysqli_connect("localhost","root","","buildecom_db");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/');
define('SITE_PATH','http://127.0.0.1/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/productimg/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/productimg/');
?>
?>