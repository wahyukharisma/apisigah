<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$response=array();
	//getData
	$id_role=$_POST['id_role'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$email=$_POST['email'];
	$id_pel=$_POST['id_pel'];

	$hash=password_hash($password,PASSWORD_BCRYPT,array('cost'=>11));

	require_once('config.php');
	//Cek email uniq
	$sql="SELECT *FROM users where username='$username';";
	$check=mysqli_fetch_array(mysqli_query($con,$sql));
	if(isset($check)){
		$response["value"]=0;
		$response["message"]='Username has been use with other registration';
		echo json_encode($response);
	}else{
		$sql="INSERT INTO users (id_user,id_role,username,password,email,id_peg,id_pel) VALUES (NULL,'$id_role','$username','$hash','$email',NULL,'$id_pel')";
		if(mysqli_query($con,$sql)){
			$response["value"]=1;
			$response["message"]="User Created";
			echo json_encode($response);
		}else{
			$response["value"]=0;
			$response["message"]='Failed Create User';
			echo json_encode($response);
		}
	}
	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Failed Create';
	echo json_encode($response);
}
?>