<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$response=array();
	require_once('config.php');
	//getData
	$id_pel=$_POST['id_pel'];
	$password=$_POST['password'];
	$oldPassword=$_POST['oldPassword'];

	$sqlHash="SELECT password from users where id_pel='$id_pel';";
	$checkHash=mysqli_fetch_array(mysqli_query($con,$sqlHash));
	if(password_verify($oldPassword,$checkHash[0])){
		$hash=password_hash($password,PASSWORD_BCRYPT,array('cost'=>11));
		$sql="UPDATE users SET password='$hash' where id_pel='1';";
		if(mysqli_query($con,$sql)){
			$response["value"]=1;
			$response["message"]="Update Success";
			echo json_encode($response);
		}else{
			$response["value"]=0;
			$response["message"]='Update Failed';
			echo json_encode($response);
		}
	}else{
		$response["value"]=0;
		$response["message"]='Old Password Not Correct';
		echo json_encode($response);
	}

	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Network Connection Error';
	echo json_encode($response);
}
?>