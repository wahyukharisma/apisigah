<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$response=array();
	//getData
	$kode_reservasi=$_POST['kode_reservasi'];

	require_once('config.php');
	//Cek email uniq
	$sql="SELECT *FROM reservasi where kode_reservasi='$kode_reservasi';";
	$check=mysqli_fetch_array(mysqli_query($con,$sql));
	if(isset($check)){
		$sql="UPDATE reservasi SET id_reservasi_status='3' where kode_reservasi='$kode_reservasi';";
		if(mysqli_query($con,$sql)){
			$response["value"]=1;
			$response["message"]="Cancel Success";
			echo json_encode($response);
		}else{
			$response["value"]=0;
			$response["message"]='Cancel Failed';
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