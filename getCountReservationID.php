<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	//getData
	$email=$_POST['email'];

	require_once('config.php');
	$sql="SELECT count(r.id_reservasi) as count from reservasi r join pelanggan p on r.id_pel=p.id_pel where p.email='$email' and r.id_reservasi_status=4 or p.email ='$email' and r.id_reservasi_status=2 ";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($res);
	if(isset($row)){
		$response["value"]=1;
		$response["message"]='Get Data';
		$result=array();
		array_push($result,array('total_reservation'=>$row[0]));
		echo json_encode(array("value"=>1,"result"=>$result));
	}else{
		$response["value"]=0;
		$response["message"]='No data found';
		echo json_encode($response);
	}
	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Network Connection Failed';
	echo json_encode($response);
}
?>