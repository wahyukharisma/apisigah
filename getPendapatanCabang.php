<?php
if($_SERVER['REQUEST_METHOD']=='GET'){
	require_once('config.php');
	
	$sql="SELECT h.alamat,DATE_FORMAT(t.tanggal_transaksi,'%Y') as Year,sum(t.jumlah_uang) as Total from transaksi t join reservasi r on t.id_reservasi=r.id_reservasi join hotel h on r.id_hotel=h.id_hotel group by h.alamat";
	$res=mysqli_query($con,$sql);
		$result=array();
		while($row=mysqli_fetch_array($res)){
			array_push($result,array('Branch'=>$row[0],'Year'=>$row[1],'Total'=>$row[2]));
		}
		echo json_encode(array("value"=>1,"result"=>$result));
	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Network Connection Failed';
	echo json_encode($response);
}
?>