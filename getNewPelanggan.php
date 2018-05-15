<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$tahun=$_POST['tahun'];
	require_once('config.php');
	$sql="SELECT DATE_FORMAT(tgl_reservasi,'%M') as Month, DATE_FORMAT(tgl_reservasi,'%Y') as Year,count(id_reservasi) as newCus from reservasi where DATE_FORMAT(tgl_reservasi,'%Y')='$tahun' group by MONTH(tgl_reservasi)";
	$res=mysqli_query($con,$sql);
		$result=array();
		while($row=mysqli_fetch_array($res)){
			array_push($result,array('Month'=>$row[0],'Year'=>$row[1],'NewPel'=>$row[2]));
		}
		echo json_encode(array("value"=>1,"result"=>$result));
	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Network Connection Failed';
	echo json_encode($response);
}
?>