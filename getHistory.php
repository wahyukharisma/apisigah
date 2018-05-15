<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	//getData
	$email=$_POST['email'];

	require_once('config.php');
	//Cek email uniq
	$sql="SELECT *FROM reservasi r join pelanggan p on r.id_pel=p.id_pel where p.email='$email' AND r.id_reservasi_status=2;";
	$res=mysqli_query($con,$sql);
	if(isset($res)){
		$response["value"]=1;
		$response["message"]='Get Data';
		$result=array();
		while($row=mysqli_fetch_array($res)){
			array_push($result,array('id_reservasi'=>$row[0],'id_peg'=>$row[1],'id_pel'=>$row[2],'id_user'=>$row[3],'id_hotel'=>$row[4],
			'id_reservasi_status'=>$row[5],'id_reservasi_tipe'=>$row[6],'kode_reservasi'=>$row[7],'nama_institusi'=>$row[8],'petiode_waktu_bayar'=>$row[9],'jumlah_kamar'=>$row[10],'dewasa'=>$row[11],'anak'=>$row[12],'urutan_reservasi'=>$row[13],'tgl_reservasi'=>$row[14]));
		}
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