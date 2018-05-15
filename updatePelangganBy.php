<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$response=array();
	//getData
	$email=$_POST['email'];
	$nama=$_POST['nama'];
	$telp=$_POST['telp'];
	$emailCek=$_POST['emailCek'];
	$id_pel=$_POST['id_pel'];

	require_once('config.php');
	//Cek email uniq
	$sql="SELECT *FROM pelanggan where email='$email' AND email not like '%$emailCek';";
	$check=mysqli_fetch_array(mysqli_query($con,$sql));
	if(isset($check)){
		$response["value"]=0;
		$response["message"]='Email has been use with other registration';
		echo json_encode($response);
	}else{
		$sql="UPDATE pelanggan SET email='$email',nama='$nama',telp='$telp' where id_pel='$id_pel';";
		if(mysqli_query($con,$sql)){
			$response["value"]=1;
			$response["message"]="Update Success";
			echo json_encode($response);
		}else{
			$response["value"]=0;
			$response["message"]='Update Failed';
			echo json_encode($response);
		}
	}
	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Network Connection Error';
	echo json_encode($response);
}
?>