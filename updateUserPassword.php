<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$response=array();
	//getData
	$email=$_POST['email'];

	require_once('config.php');
	//Cek email uniq
	$sql="SELECT *FROM users where email='$email';";
	$check=mysqli_fetch_array(mysqli_query($con,$sql));
	if(isset($check)){
		$hash=password_hash($check[2],PASSWORD_BCRYPT,array('cost'=>11));
		$sql="UPDATE users SET password='$hash' where email='$email';";
		if(mysqli_query($con,$sql)){
			$response["value"]=1;
			$response["message"]="Email has been send";
			echo json_encode($response);
		}else{
			$response["value"]=0;
			$response["message"]='Failed';
			echo json_encode($response);
		}
	}else{
		$response["value"]=0;
		$response["message"]='Network Connection Error';
		echo json_encode($response);
	}
	mysqli_close($con);
}

?>