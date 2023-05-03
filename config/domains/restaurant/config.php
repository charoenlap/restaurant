<?php
	// opcache_reset();
	// ini_set("soap.wsdl_cache_enabled", "0");
	
  	define('DEBUG_MODE',false);
  	define('TYPE_LOCAL','win');
	// define('TYPE_LOCAL','mac');

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
 
	define('cache_db','0');
	if($_SERVER['SERVER_NAME'] != 'localhost'){
		// Config DB SERVER
		define('PREFIX', 'res_');
		define('DB_HOST','localhost');
		define('DB_USER','charoenlap_res');
		define('DB_PASS','1Kq80dSn');
		define('DB_DB','charoenlap_res');
		$base = '/home/charoenlap/domains/charoenlap.com/public_html/restaurant/public_html/';
		define('DOCUMENT_ROOT','/home/charoenlap/domains/charoenlap.com/public_html/restaurant/lib/');
		define('DOCUMENT_ROOT_LINE','/home/charoenlap/domains/charoenlap.com/public_html/restaurant/line/');
		define('MURL','http://charoenlap.com/restaurant/');
		define('PATH_JSON','/home/charoenlap/domains/charoenlap.com/public_html/restaurant/json/');
	}else{
		if(TYPE_LOCAL=='win'){
			define('PREFIX', 'res_');
			define('DB_HOST','localhost');
			define('DB_USER','root');
			define('DB_PASS','root');
			define('DB_DB','restaurant');
			$base = $_SERVER['DOCUMENT_ROOT'].'/restaurant/public_html/';
			define('DOCUMENT_ROOT','C:\MAMP\htdocs\restaurant\lib/');
			define('DOCUMENT_ROOT_LINE','C:\MAMP\htdocs\restaurant\public_html/line/');
			define('MURL','http://localhost/restaurant/public_html/');
			define('PATH_JSON','C:\MAMP\htdocs\restaurant\json/');
		}else{
			define('PREFIX', 'res_');
			define('DB_HOST','localhost');
			define('DB_USER','root');
			define('DB_PASS','root');
			define('DB_DB','restaurant');
			$base = $_SERVER['DOCUMENT_ROOT'].'/restaurant/public_html/';
			define('DOCUMENT_ROOT','/Users/charoenlapanatamsombat/Documents/htdocs/restaurant/lib/');
			define('DOCUMENT_ROOT_LINE','/Users/charoenlapanatamsombat/Documents/htdocs/restaurant/public_html/line/');
			define('MURL','http://localhost/restaurant/public_html/');
			define('PATH_JSON','/Users/charoenlapanatamsombat/Documents/htdocs/restaurant/json/');
		}
	}
	// SCB
	define('api_key','l73f905a88c166488ba74247d18a3cd5b4');
	define('api_secret','d4cd08ad55d44bc9a142fc48513ec58e');
	define('url','https://api.partners.scb/partners/');
	define('billerId','036556100034614');
	// end point -> https://api.yaksri.com/gateway/scb/payment-confim/

  	// URL for production
  	// http://service.1111.go.th
	// $url = "http://203.113.25.98/CoreService/SOAP/";



	// OPM WEB SERVICE FOR TEST
	// $url_test = "http://203.113.25.98/OPMApplication";

	// $username = "opmegov";
	// $password = "opmegov";

	// $username_egov = "serviceegov";
	// $password_egov = "serviceegov";
	
	define('DATE_FORMAT','Y-m-d');

	// define('MURL','https://www.fsoftpro.com/dohung/');
	
	define('ROW_IN_DOC','10');
	define('BYTE_PER_KB','1000');
	 
	// define('app_id','166994808024757');
	// define('app_secret','b0bf73fa492cfd8b4d0125eeda9d5e51');
	// define('default_graph_version','v2.10');

	// define('GOOGLE_CLIENT_ID', '310104410325-k5ufrsold5trpadn00c424vidtqc2lpt.apps.googleusercontent.com');
	// define('GOOGLE_CLIENT_SECRET', 'k-mfqWUZaQoL5r-rpu9NM1fP');
	// define('GOOGLE_REDIRECT_URL', MURL.'index.php?route=user/gmailCallback');

	define('DEFAULT_PAGE','home');
	define('WEB_NAME','');
	define('IMAGE',MURL.'uploads/');
	define('IMAGE_PHOTO',MURL.'uploads/photo/'); 
	define('NO_PHOTO',MURL.'uploads/no_photo.jpg');
	define('DB','mysqli');
	define('KEY', 'appcom@fsp88');
	
	
	// Production
	// define('PREFIX', 'dh_');
	// define('DB_HOST','localhost');
	// define('DB_USER','fsoftpro_dhpro');
	// define('DB_PASS','29bGG94RSg');
	// define('DB_DB','fsoftpro_dhpro');

	// System config 
	define('DEFAULT_LANGUAGE','1');
	define('DEFAULT_LIMIT_PAGE','10');

	// email ssl
	// define('email_username','support@fsoftpro.com');
	// define('email_password','fiverama2');
	// define('email_host','smtp.gmail.com');
	// define('email_port','465');
	// define('email_send','support@fsoftpro.com');
	// define('email_stmpsecure','ssl');

	// email tls
	// define('email_username','info@e-petition.energy.go.th');
	// define('email_password','');
	// define('email_host','');
	// define('email_port','25');
	// define('email_send','');
	// define('email_stmpsecure','TLS');

	// use PHPMailer\PHPMailer\PHPMailer;
	// use PHPMailer\PHPMailer\Exception;

	// require DOCUMENT_ROOT.'/system/lib/PHPMailer-master-7/src/Exception.php';
	// require DOCUMENT_ROOT.'/system/lib/PHPMailer-master-7/src/PHPMailer.php';
	// require DOCUMENT_ROOT.'/system/lib/PHPMailer-master-7/src/SMTP.php';
	// global	$mail ;
	// $mail = new PHPMailer(true); //New instance, with exceptions enabled

	
?>