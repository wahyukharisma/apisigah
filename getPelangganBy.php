<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	//getData
	$id_pel=$_POST['id_pel'];

	require_once('config.php');
	//Cek email uniq
	$sql="SELECT *FROM pelanggan where id_pel='$id_pel';";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($res);
	if(isset($row)){
		$response["value"]=1;
		$response["message"]='Get Data';
		$result=array();
		array_push($result,array('id_pel'=>$row[0],'id_role'=>$row[1],'email'=>$row[2],'nama'=>$row[3],'no_identitas'=>$row[4],
			'telp'=>$row[5],'alamat'=>$row[6]));
		echo json_encode(array("value"=>1,"result"=>$result));
	}else{
		$response["value"]=0;
		$response["message"]='Data not found';
		echo json_encode($response);
	}
	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Network Connection Failed';
	echo json_encode($response);
}
?>