<?php 
	define('HOST','192.168.19.140');
	define('USER','pp8214');
	define('PASS','8214');
	define('DB','8214');
	/*define('HOST','localhost');
	define('USER','root');
	define('PASS','');
	define('DB','8214');*/
	
	$con=mysqli_connect(HOST,USER,PASS,DB) or die('Unable to connect');
?>