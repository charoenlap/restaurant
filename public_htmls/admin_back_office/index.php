<?php 
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set('Asia/Bangkok');
	
	ini_set( 'upload_max_size' , '64M' );
    ini_set( 'post_max_size', '64M');
    ini_set( 'max_execution_time', '300' );

	ob_start();
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	if($_SERVER['SERVER_NAME'] == 'localhost'){
		require_once($_SERVER['DOCUMENT_ROOT'].'/restaurant/config/domains/restaurant/config.php'); 
		require_once($_SERVER['DOCUMENT_ROOT'].'/restaurant/lib/function/main_function.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/restaurant/public_htmls/admin_back_office/catalog/setup.php'); 
		require_once($_SERVER['DOCUMENT_ROOT'].'/restaurant/lib/system/loader/autoload.php');
	}else{
		require_once('C:\xampp\htdocs\web/restaurant/config/domains/restaurant/config.php');
		require_once('C:\xampp\htdocs\web/restaurant/lib/function/main_function.php');
		require_once('C:\xampp\htdocs\web/restaurant/public_htmls/admin_back_office/catalog/setup.php');
		require_once('C:\xampp\htdocs\web/restaurant/lib/system/loader/autoload.php');
	}
?>