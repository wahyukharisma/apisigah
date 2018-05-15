<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$response=array();
	//getData
	$email=$_POST['email'];
	$emailTemp=$_POST['emailTemp'];

	require_once('config.php');
	//Cek email uniq
	$sql="SELECT *FROM users where email='$email';";
	$check=mysqli_fetch_array(mysqli_query($con,$sql));
	if(isset($check)){
		$sql="UPDATE users SET email='$emailTemp' where email='$email';";
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
		$response["message"]='Network Connection Error';
		echo json_encode($response);
	}
	mysqli_close($con);
}

?>