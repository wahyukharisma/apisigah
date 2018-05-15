<?php
$password="doge";
require_once('config.php');
$sql="SELECT password from users where username='doge'";
$res=mysqli_query($con,$sql);
$row=mysqli_fetch_row($res);

if(password_verify($password,$row[0])){
	echo "Correct";
}else{
	echo "Not Correct";
}
?>