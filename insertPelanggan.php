<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$response=array();
	//getData
	$id_role=$_POST['id_role'];
	$email=$_POST['email'];
	$nama=$_POST['nama'];
	$no_identitas=$_POST['no_identitas'];
	$telp=$_POST['telp'];
	$alamat=$_POST['alamat'];
	$username=$_POST['username'];

	require_once('config.php');
	//Cek email uniq
	$sql="SELECT *FROM pelanggan where email='$email';";
	$sql2="SELECT *FROM pelanggan where no_identitas='$no_identitas';";
	$sql3="SELECT *FROM users where username='$username';";
	$checkEmail=mysqli_fetch_array(mysqli_query($con,$sql));
	$checkId=mysqli_fetch_array(mysqli_query($con,$sql2));
	$checkUsername=mysqli_fetch_array(mysqli_query($con,$sql3));

	if(isset($checkEmail) or isset($checkId) or isset($checkUsername)){
		if(isset($checkEmail)){
			$response["value"]=0;
			$response["message"]='Email has been use with other registration';
			echo json_encode($response);
		}
		if(isset($checkId)){
			$response["value"]=0;
			$response["message"]='Identitiy number has been use with other registration';
			echo json_encode($response);
		}
		if(isset($checkUsername)){
			$response["value"]=0;
			$response["message"]='Username has been use with other registration';
			echo json_encode($response);
		}
	}else{
		$sql="INSERT INTO pelanggan (id_pel,id_role,email,nama,no_identitas,telp,alamat) VALUES (NULL,'$id_role','$email','$nama','$no_identitas','$telp','$alamat');";
		if(mysqli_query($con,$sql)){
			$response["value"]=1;
			$response["message"]="Registration Success";
			echo json_encode($response);
		}else{
			$response["value"]=0;
			$response["message"]='Failed Registration';
			echo json_encode($response);
		}
	}
	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Failed Registration';
	echo json_encode($response);
}
?>