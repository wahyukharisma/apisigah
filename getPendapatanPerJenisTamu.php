<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$tahun=$_POST['tahun'];
	require_once('config.php');
	//Cek email uniq
	$sql="SELECT r.id_reservasi_tipe,DATE_FORMAT(t.tanggal_transaksi,'%M') as Month,SUM(jumlah_uang) as Total from transaksi t join reservasi r on t.id_reservasi=r.id_reservasi where DATE_FORMAT(t.tanggal_transaksi,'%Y')='$tahun' group by r.id_reservasi_tipe,DATE_FORMAT(t.tanggal_transaksi,'%M')";
	$res=mysqli_query($con,$sql);
		$result=array();
		while($row=mysqli_fetch_array($res)){
			array_push($result,array('ReservationType'=>$row[0],'Month'=>$row[1],'Income'=>$row[2]));
		}
		echo json_encode(array("value"=>1,"result"=>$result));
	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Network Connection Failed';
	echo json_encode($response);
}
?>