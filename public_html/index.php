<?php 
	// var_dump($_SERVER);
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set('Asia/Bangkok');
	
	ob_start();
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	// echo $_SERVER['SERVER_NAME'];exit();
	// echo "อยู่ระหว่างการปรับปรุงระบบ";exit();
	if($_SERVER['SERVER_NAME'] == 'localhost'){
		require_once($_SERVER['DOCUMENT_ROOT'].'/restaurant/config/domains/restaurant/config.php'); 
		require_once($_SERVER['DOCUMENT_ROOT'].'/restaurant/lib/function/main_function.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/restaurant/public_html/catalog/setup.php'); 
		require_once($_SERVER['DOCUMENT_ROOT'].'/restaurant/lib/system/loader/autoload.php'); 
	}else{
		require_once('/home/charoenlap/domains/charoenlap.com/public_html/restaurant/config/domains/restaurant/config.php'); 
		require_once('/home/charoenlap/domains/charoenlap.com/public_html/restaurant/lib/function/main_function.php');
		require_once('catalog/setup.php'); 
		require_once('/home/charoenlap/domains/charoenlap.com/public_html/restaurant/lib/system/loader/autoload.php'); 
	}
?>