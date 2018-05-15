<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	//getData
	$email=$_POST['email'];

	require_once('config.php');
	//Cek email uniq
	$sql="SELECT * from reservasi r join pelanggan p on r.id_pel=p.id_pel join tipereservasi t on r.id_reservasi_tipe=t.id_reservasi_tipe join hotel h on r.id_hotel=h.id_hotel join reservasistatus rs on r.id_reservasi_status= rs.id_reservasi_status where p.id_pel='$email' and r.id_reservasi_status=2";
	$res=mysqli_query($con,$sql);
	$result=array();
	while($get=mysqli_fetch_array($res)){
		array_push($result,array('id_reservasi'=>$get[0],'id_peg'=>$get[1],'nama'=>$get[18],'id_user'=>$get[3],'alamat'=>$get[25],
		'reservasi_status'=>$get[28],'reservasi_tipe'=>$get[23],'kode_reservasi'=>$get[7],'nama_institusi'=>$get[8],'periode_waktu_bayar'=>$get[9],
		'jumlah_kamar'=>$get[10],'dewasa'=>$get[11],'anak'=>$get[12],'urutan_reservasi'=>$get[13],'tgl_reservasi'=>$get[14]));
	}
	echo json_encode(array("value"=>1,"result"=>$result));
	mysqli_close($con);
}else{
	$response["value"]=0;
	$response["message"]='Network Connection Failed';
	echo json_encode($response);
}
?>